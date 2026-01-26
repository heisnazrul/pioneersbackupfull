<?php

namespace App\Support;

use App\Models\AgentReferral;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Str;

class ReferralManager
{
    private const SESSION_KEY = 'referral.code';

    public static function generateUniqueCode(): string
    {
        do {
            $code = Str::upper(Str::random(8));
        } while (AgentReferral::where('code', $code)->exists());

        return $code;
    }

    public static function currentCode(): ?string
    {
        if (! self::sessionAvailable()) {
            return null;
        }

        return session(self::SESSION_KEY);
    }

    public static function storeCode(string $code): void
    {
        if (! self::sessionAvailable()) {
            return;
        }

        session([self::SESSION_KEY => $code]);
    }

    public static function clearCode(): void
    {
        if (! self::sessionAvailable()) {
            return;
        }

        session()->forget(self::SESSION_KEY);
    }

    public static function resolveReferrerByCode(string $code): ?User
    {
        $referral = AgentReferral::where('code', $code)->first();

        return $referral?->agent;
    }

    public static function currentReferrer(bool $consume = false): ?User
    {
        $code = self::currentCode();

        if (! $code) {
            return null;
        }

        $referrer = self::resolveReferrerByCode($code);

        if ($consume) {
            self::clearCode();
        }

        return $referrer;
    }

    public static function applyCurrentReferrer(User $user): void
    {
        if (! in_array($user->role, ['student', 'agent'])) {
            return;
        }

        $referrer = self::currentReferrer(true);

        if (! $referrer) {
            return;
        }

        self::assignReferrer($user, $referrer);
    }

    public static function assignReferrer(User $user, User $referrer): void
    {
        $info = $user->info;

        if ($referrer->role !== 'agent') {
            return;
        }

        if (! $info) {
            $info = $user->info()->create();
        }

        if ($info->referred_by_user_id) {
            return;
        }

        $info->referred_by_user_id = $referrer->id;
        $info->save();
    }

    public static function referralLink(User $user): ?string
    {
        $code = $user->agentReferral?->code;

        return $code ? route('referral.handle', $code) : null;
    }

    private static function sessionAvailable(): bool
    {
        if (! app()->bound('session')) {
            return false;
        }

        $session = session();

        if (! $session->isStarted()) {
            $session->start();
        }

        return true;
    }
}
