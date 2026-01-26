<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    DashboardController, CountryController, CityController, AccreditationController, TagController,
    CourseTypeController, SchoolController, CourseController, OnlineCourseController, SummerCampController, CourseFeeController, SummerController,
    HighSeasonFeeController, RegistrationFeeController, MaterialFeeController,
    PickupController, InsuranceFeeController, AccommodationController, SupplementController, BathroomController, BedroomController, MealController,
    DiscountController, ReferralDiscountController, PioneersDiscountController,
    CouponController, WishListController, ReviewController, BlogController, FaqController,
    CategoryController, UserController, FamilyController, CertificationController,
    BranchController, AdminController, ExchangeRateController, ConversionFeeController, TranslationController,
    CampInfoController, CampFeeController, CampMediaController, SettingsController,
    UniversityController, UniversityCampusController, UniversityCourseController, IntakeController,
    CourseRequirementController, ProfileController, LanguageCourseTagController, MealPlanController,
    BedroomTypeController, BathroomTypeController, LanguageCourseTypeController, SchoolBranchController, LanguageCourseController,
    LanguageCourseFeeController, LanguageCourseMaterialFeeController, BranchRegistrationFeeController, BranchHighSeasonFeeController,
    TrainingCourseController, SummerCampDetailController, GalleryController, MaintenanceController, PreferredSchoolController
};

use App\Http\Controllers\Admin\AgentReferralController;


Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/admin/dashboard', function () { return view('admin.dashboard'); })->name('admin.dashboard');
Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
Route::put('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
Route::post('/admin/maintenance/clear-cache', [MaintenanceController::class, 'clearCache'])->name('admin.maintenance.clear-cache');

Route::get('/admin/countries', [CountryController::class, 'index'])->name('admin.countries.index');
Route::get('/admin/countries/create', [CountryController::class, 'create'])->name('admin.countries.create');
Route::post('/admin/countries', [CountryController::class, 'store'])->name('admin.countries.store');
Route::get('/admin/countries/{country}/edit', [CountryController::class, 'edit'])->name('admin.countries.edit');
Route::put('/admin/countries/{country}', [CountryController::class, 'update'])->name('admin.countries.update');
Route::delete('/admin/countries/{country}', [CountryController::class, 'destroy'])->name('admin.countries.destroy');

Route::get('/admin/cities', [CityController::class, 'index'])->name('admin.cities.index');
Route::get('/admin/cities/create', [CityController::class, 'create'])->name('admin.cities.create');
Route::post('/admin/cities', [CityController::class, 'store'])->name('admin.cities.store');
Route::get('/admin/cities/{city}/edit', [CityController::class, 'edit'])->name('admin.cities.edit');
Route::put('/admin/cities/{city}', [CityController::class, 'update'])->name('admin.cities.update');
Route::delete('/admin/cities/{city}', [CityController::class, 'destroy'])->name('admin.cities.destroy');

Route::get('/admin/schools', [SchoolController::class, 'index'])->name('admin.schools.index');
Route::get('/admin/schools/create', [SchoolController::class, 'create'])->name('admin.schools.create');
Route::post('/admin/schools', [SchoolController::class, 'store'])->name('admin.schools.store');
Route::get('/admin/schools/{school}/edit', [SchoolController::class, 'edit'])->name('admin.schools.edit');
Route::put('/admin/schools/{school}', [SchoolController::class, 'update'])->name('admin.schools.update');
Route::delete('/admin/schools/{school}', [SchoolController::class, 'destroy'])->name('admin.schools.destroy');

// School Branches
Route::get('/admin/school-branches', [SchoolBranchController::class, 'index'])->name('admin.school-branches.index');
Route::get('/admin/school-branches/create', [SchoolBranchController::class, 'create'])->name('admin.school-branches.create');
Route::post('/admin/school-branches', [SchoolBranchController::class, 'store'])->name('admin.school-branches.store');
Route::get('/admin/school-branches/{schoolBranch}/edit', [SchoolBranchController::class, 'edit'])->name('admin.school-branches.edit');
Route::put('/admin/school-branches/{schoolBranch}', [SchoolBranchController::class, 'update'])->name('admin.school-branches.update');
Route::delete('/admin/school-branches/{schoolBranch}', [SchoolBranchController::class, 'destroy'])->name('admin.school-branches.destroy');

Route::get('/admin/accreditations', [AccreditationController::class, 'index'])->name('admin.accreditations.index');
Route::get('/admin/accreditations/create', [AccreditationController::class, 'create'])->name('admin.accreditations.create');
Route::post('/admin/accreditations', [AccreditationController::class, 'store'])->name('admin.accreditations.store');
Route::get('/admin/accreditations/{accreditation}/edit', [AccreditationController::class, 'edit'])->name('admin.accreditations.edit');
Route::put('/admin/accreditations/{accreditation}', [AccreditationController::class, 'update'])->name('admin.accreditations.update');
Route::delete('/admin/accreditations/{accreditation}', [AccreditationController::class, 'destroy'])->name('admin.accreditations.destroy');

// Tags Routes
Route::get('/admin/tags', [TagController::class, 'index'])->name('admin.tags.index');
Route::get('/admin/tags/create', [TagController::class, 'create'])->name('admin.tags.create');
Route::post('/admin/tags', [TagController::class, 'store'])->name('admin.tags.store');
Route::get('/admin/tags/{tag}/edit', [TagController::class, 'edit'])->name('admin.tags.edit');
Route::put('/admin/tags/{tag}', [TagController::class, 'update'])->name('admin.tags.update');
Route::delete('/admin/tags/{tag}', [TagController::class, 'destroy'])->name('admin.tags.destroy');

// Language Course Tags Routes
Route::get('/admin/language-course-tags', [LanguageCourseTagController::class, 'index'])->name('admin.language-course-tags.index');
Route::get('/admin/language-course-tags/create', [LanguageCourseTagController::class, 'create'])->name('admin.language-course-tags.create');
Route::post('/admin/language-course-tags', [LanguageCourseTagController::class, 'store'])->name('admin.language-course-tags.store');
Route::get('/admin/language-course-tags/{languageCourseTag}/edit', [LanguageCourseTagController::class, 'edit'])->name('admin.language-course-tags.edit');
Route::put('/admin/language-course-tags/{languageCourseTag}', [LanguageCourseTagController::class, 'update'])->name('admin.language-course-tags.update');
Route::delete('/admin/language-course-tags/{languageCourseTag}', [LanguageCourseTagController::class, 'destroy'])->name('admin.language-course-tags.destroy');

// CourseTypes Routes
Route::get('/admin/course-types', [CourseTypeController::class, 'index'])->name('admin.course-types.index');
Route::get('/admin/course-types/create', [CourseTypeController::class, 'create'])->name('admin.course-types.create');
Route::post('/admin/course-types', [CourseTypeController::class, 'store'])->name('admin.course-types.store');
Route::get('/admin/course-types/{courseType}/edit', [CourseTypeController::class, 'edit'])->name('admin.course-types.edit');
Route::put('/admin/course-types/{courseType}', [CourseTypeController::class, 'update'])->name('admin.course-types.update');
Route::delete('/admin/course-types/{courseType}', [CourseTypeController::class, 'destroy'])->name('admin.course-types.destroy');

// Language Course Types Routes
Route::get('/admin/language-course-types', [LanguageCourseTypeController::class, 'index'])->name('admin.language-course-types.index');
Route::get('/admin/language-course-types/create', [LanguageCourseTypeController::class, 'create'])->name('admin.language-course-types.create');
Route::post('/admin/language-course-types', [LanguageCourseTypeController::class, 'store'])->name('admin.language-course-types.store');
Route::get('/admin/language-course-types/{languageCourseType}/edit', [LanguageCourseTypeController::class, 'edit'])->name('admin.language-course-types.edit');
Route::put('/admin/language-course-types/{languageCourseType}', [LanguageCourseTypeController::class, 'update'])->name('admin.language-course-types.update');
Route::delete('/admin/language-course-types/{languageCourseType}', [LanguageCourseTypeController::class, 'destroy'])->name('admin.language-course-types.destroy');

// Language Courses
Route::get('/admin/language-courses', [LanguageCourseController::class, 'index'])->name('admin.language-courses.index');
Route::get('/admin/language-courses/create', [LanguageCourseController::class, 'create'])->name('admin.language-courses.create');
Route::post('/admin/language-courses', [LanguageCourseController::class, 'store'])->name('admin.language-courses.store');
Route::get('/admin/language-courses/{languageCourse}/edit', [LanguageCourseController::class, 'edit'])->name('admin.language-courses.edit');
Route::put('/admin/language-courses/{languageCourse}', [LanguageCourseController::class, 'update'])->name('admin.language-courses.update');
Route::delete('/admin/language-courses/{languageCourse}', [LanguageCourseController::class, 'destroy'])->name('admin.language-courses.destroy');

// Branch Routes
Route::get('/admin/branches', [BranchController::class, 'index'])->name('admin.branches.index');
Route::get('/admin/branches/create', [BranchController::class, 'create'])->name('admin.branches.create');
Route::post('/admin/branches', [BranchController::class, 'store'])->name('admin.branches.store');
Route::get('/admin/branches/{branch}/edit', [BranchController::class, 'edit'])->name('admin.branches.edit');
Route::put('/admin/branches/{branch}', [BranchController::class, 'update'])->name('admin.branches.update');
Route::delete('/admin/branches/{branch}', [BranchController::class, 'destroy'])->name('admin.branches.destroy');

// Course Routes
Route::get('/admin/courses', [CourseController::class, 'index'])->name('admin.courses.index');
Route::get('/admin/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');
Route::post('/admin/courses', [CourseController::class, 'store'])->name('admin.courses.store');
Route::get('/admin/courses/{course}/edit', [CourseController::class, 'edit'])->name('admin.courses.edit');
Route::put('/admin/courses/{course}', [CourseController::class, 'update'])->name('admin.courses.update');
Route::delete('/admin/courses/{course}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');

Route::get('/admin/online-courses', [OnlineCourseController::class, 'index'])->name('admin.online-courses.index');
Route::get('/admin/online-courses/create', [OnlineCourseController::class, 'create'])->name('admin.online-courses.create');
Route::post('/admin/online-courses', [OnlineCourseController::class, 'store'])->name('admin.online-courses.store');
Route::get('/admin/online-courses/{onlineCourse}/edit', [OnlineCourseController::class, 'edit'])->name('admin.online-courses.edit');
Route::put('/admin/online-courses/{onlineCourse}', [OnlineCourseController::class, 'update'])->name('admin.online-courses.update');
Route::delete('/admin/online-courses/{onlineCourse}', [OnlineCourseController::class, 'destroy'])->name('admin.online-courses.destroy');

Route::get('/admin/summer-camps', [SummerCampController::class, 'index'])->name('admin.summer-camps.index');
Route::get('/admin/summer-camps/create', [SummerCampController::class, 'create'])->name('admin.summer-camps.create');
Route::post('/admin/summer-camps', [SummerCampController::class, 'store'])->name('admin.summer-camps.store');
Route::get('/admin/summer-camps/{summerCamp}/edit', [SummerCampController::class, 'edit'])->name('admin.summer-camps.edit');
Route::put('/admin/summer-camps/{summerCamp}', [SummerCampController::class, 'update'])->name('admin.summer-camps.update');
Route::delete('/admin/summer-camps/{summerCamp}', [SummerCampController::class, 'destroy'])->name('admin.summer-camps.destroy');

Route::get('/admin/summer-camp-details', [SummerCampDetailController::class, 'index'])->name('admin.summer-camp-details.index');
Route::get('/admin/summer-camp-details/create', [SummerCampDetailController::class, 'create'])->name('admin.summer-camp-details.create');
Route::post('/admin/summer-camp-details', [SummerCampDetailController::class, 'store'])->name('admin.summer-camp-details.store');
Route::get('/admin/summer-camp-details/{summerCampDetail}/edit', [SummerCampDetailController::class, 'edit'])->name('admin.summer-camp-details.edit');
Route::put('/admin/summer-camp-details/{summerCampDetail}', [SummerCampDetailController::class, 'update'])->name('admin.summer-camp-details.update');
Route::delete('/admin/summer-camp-details/{summerCampDetail}', [SummerCampDetailController::class, 'destroy'])->name('admin.summer-camp-details.destroy');

Route::get('/admin/training-courses', [TrainingCourseController::class, 'index'])->name('admin.training-courses.index');
Route::get('/admin/training-courses/create', [TrainingCourseController::class, 'create'])->name('admin.training-courses.create');
Route::post('/admin/training-courses', [TrainingCourseController::class, 'store'])->name('admin.training-courses.store');
Route::get('/admin/training-courses/{trainingCourse}/edit', [TrainingCourseController::class, 'edit'])->name('admin.training-courses.edit');
Route::put('/admin/training-courses/{trainingCourse}', [TrainingCourseController::class, 'update'])->name('admin.training-courses.update');
Route::delete('/admin/training-courses/{trainingCourse}', [TrainingCourseController::class, 'destroy'])->name('admin.training-courses.destroy');

Route::get('/admin/camp-infos', [CampInfoController::class, 'index'])->name('admin.camp-infos.index');
Route::get('/admin/camp-infos/create', [CampInfoController::class, 'create'])->name('admin.camp-infos.create');
Route::post('/admin/camp-infos', [CampInfoController::class, 'store'])->name('admin.camp-infos.store');
Route::get('/admin/camp-infos/{campInfo}/edit', [CampInfoController::class, 'edit'])->name('admin.camp-infos.edit');
Route::put('/admin/camp-infos/{campInfo}', [CampInfoController::class, 'update'])->name('admin.camp-infos.update');
Route::delete('/admin/camp-infos/{campInfo}', [CampInfoController::class, 'destroy'])->name('admin.camp-infos.destroy');

Route::get('/admin/camp-fees', [CampFeeController::class, 'index'])->name('admin.camp-fees.index');
Route::get('/admin/camp-fees/create', [CampFeeController::class, 'create'])->name('admin.camp-fees.create');
Route::post('/admin/camp-fees', [CampFeeController::class, 'store'])->name('admin.camp-fees.store');
Route::get('/admin/camp-fees/{campFee}/edit', [CampFeeController::class, 'edit'])->name('admin.camp-fees.edit');
Route::put('/admin/camp-fees/{campFee}', [CampFeeController::class, 'update'])->name('admin.camp-fees.update');
Route::delete('/admin/camp-fees/{campFee}', [CampFeeController::class, 'destroy'])->name('admin.camp-fees.destroy');

Route::get('/admin/camp-media', [CampMediaController::class, 'index'])->name('admin.camp-media.index');
Route::get('/admin/camp-media/create', [CampMediaController::class, 'create'])->name('admin.camp-media.create');
Route::post('/admin/camp-media', [CampMediaController::class, 'store'])->name('admin.camp-media.store');
Route::get('/admin/camp-media/{campMedium}/edit', [CampMediaController::class, 'edit'])->name('admin.camp-media.edit');
Route::put('/admin/camp-media/{campMedium}', [CampMediaController::class, 'update'])->name('admin.camp-media.update');
Route::delete('/admin/camp-media/{campMedium}', [CampMediaController::class, 'destroy'])->name('admin.camp-media.destroy');

// Discounts
Route::get('/admin/discounts', [DiscountController::class, 'index'])->name('admin.discounts.index');
Route::get('/admin/discounts/create', [DiscountController::class, 'create'])->name('admin.discounts.create');
Route::post('/admin/discounts', [DiscountController::class, 'store'])->name('admin.discounts.store');
Route::get('/admin/discounts/{discount}/edit', [DiscountController::class, 'edit'])->name('admin.discounts.edit');
Route::put('/admin/discounts/{discount}', [DiscountController::class, 'update'])->name('admin.discounts.update');
Route::delete('/admin/discounts/{discount}', [DiscountController::class, 'destroy'])->name('admin.discounts.destroy');

// Coupons
Route::get('/admin/coupons', [CouponController::class, 'index'])->name('admin.coupons.index');
Route::get('/admin/coupons/create', [CouponController::class, 'create'])->name('admin.coupons.create');
Route::post('/admin/coupons', [CouponController::class, 'store'])->name('admin.coupons.store');
Route::get('/admin/coupons/{coupon}/edit', [CouponController::class, 'edit'])->name('admin.coupons.edit');
Route::put('/admin/coupons/{coupon}', [CouponController::class, 'update'])->name('admin.coupons.update');
Route::delete('/admin/coupons/{coupon}', [CouponController::class, 'destroy'])->name('admin.coupons.destroy');

// Course Fee Routes
Route::get('/admin/course-fees', [CourseFeeController::class, 'index'])->name('admin.course-fees.index');
Route::get('/admin/course-fees/create', [CourseFeeController::class, 'create'])->name('admin.course-fees.create');
Route::post('/admin/course-fees', [CourseFeeController::class, 'store'])->name('admin.course-fees.store');
Route::get('/admin/course-fees/{course}/edit', [CourseFeeController::class, 'editByCourse'])->name('admin.course-fees.edit');
Route::put('/admin/course-fees/{course}', [CourseFeeController::class, 'updateByCourse'])->name('admin.course-fees.update');
Route::delete('/admin/course-fees/{course}', [CourseFeeController::class, 'destroy'])->name('admin.course-fees.destroy');
Route::get('/admin/course-fees/fetch/{course}', [CourseFeeController::class, 'fetch'])->name('admin.course-fees.fetch');

// Language Course Fee Routes
Route::get('/admin/language-course-fees', [LanguageCourseFeeController::class, 'index'])->name('admin.language-course-fees.index');
Route::get('/admin/language-course-fees/create', [LanguageCourseFeeController::class, 'create'])->name('admin.language-course-fees.create');
Route::post('/admin/language-course-fees', [LanguageCourseFeeController::class, 'store'])->name('admin.language-course-fees.store');
Route::get('/admin/language-course-fees/{languageCourseFee}/edit', [LanguageCourseFeeController::class, 'edit'])->name('admin.language-course-fees.edit');
Route::put('/admin/language-course-fees/{languageCourseFee}', [LanguageCourseFeeController::class, 'update'])->name('admin.language-course-fees.update');
Route::delete('/admin/language-course-fees/{languageCourseFee}', [LanguageCourseFeeController::class, 'destroy'])->name('admin.language-course-fees.destroy');
Route::get('/admin/language-course-fees/fetch/{languageCourse}', [LanguageCourseFeeController::class, 'fetch'])->name('admin.language-course-fees.fetch');

// Language Course Material Fees
Route::get('/admin/language-course-material-fees', [LanguageCourseMaterialFeeController::class, 'index'])->name('admin.language-course-material-fees.index');
Route::get('/admin/language-course-material-fees/create', [LanguageCourseMaterialFeeController::class, 'create'])->name('admin.language-course-material-fees.create');
Route::post('/admin/language-course-material-fees', [LanguageCourseMaterialFeeController::class, 'store'])->name('admin.language-course-material-fees.store');
Route::get('/admin/language-course-material-fees/{languageCourseMaterialFee}/edit', [LanguageCourseMaterialFeeController::class, 'edit'])->name('admin.language-course-material-fees.edit');
Route::put('/admin/language-course-material-fees/{languageCourseMaterialFee}', [LanguageCourseMaterialFeeController::class, 'update'])->name('admin.language-course-material-fees.update');
Route::delete('/admin/language-course-material-fees/{languageCourseMaterialFee}', [LanguageCourseMaterialFeeController::class, 'destroy'])->name('admin.language-course-material-fees.destroy');

// Agents Management
Route::get('/admin/agents', [AgentController::class, 'index'])->name('admin.agents.index');
Route::get('/admin/agents/{agent}/edit', [AgentController::class, 'edit'])->name('admin.agents.edit');
Route::put('/admin/agents/{agent}', [AgentController::class, 'update'])->name('admin.agents.update');
Route::delete('/admin/agents/{agent}', [AgentController::class, 'destroy'])->name('admin.agents.destroy');
Route::post('/admin/agents/{agent}/approve', [AgentController::class, 'approve'])->name('admin.agents.approve');

// High Season Fees
Route::get('/admin/high-season-fees', [HighSeasonFeeController::class, 'index'])->name('admin.high-season-fees.index');
Route::get('/admin/high-season-fees/create', [HighSeasonFeeController::class, 'create'])->name('admin.high-season-fees.create');
Route::post('/admin/high-season-fees', [HighSeasonFeeController::class, 'store'])->name('admin.high-season-fees.store');
Route::get('/admin/high-season-fees/{highSeasonFee}/edit', [HighSeasonFeeController::class, 'edit'])->name('admin.high-season-fees.edit');
Route::put('/admin/high-season-fees/{highSeasonFee}', [HighSeasonFeeController::class, 'update'])->name('admin.high-season-fees.update');
Route::delete('/admin/high-season-fees/{highSeasonFee}', [HighSeasonFeeController::class, 'destroy'])->name('admin.high-season-fees.destroy');
// Registration Fees
Route::get('/admin/registration-fees', [RegistrationFeeController::class, 'index'])->name('admin.registration-fees.index');
Route::get('/admin/registration-fees/create', [RegistrationFeeController::class, 'create'])->name('admin.registration-fees.create');
Route::post('/admin/registration-fees', [RegistrationFeeController::class, 'store'])->name('admin.registration-fees.store');
Route::get('/admin/registration-fees/{registrationFee}/edit', [RegistrationFeeController::class, 'edit'])->name('admin.registration-fees.edit');
Route::put('/admin/registration-fees/{registrationFee}', [RegistrationFeeController::class, 'update'])->name('admin.registration-fees.update');
Route::delete('/admin/registration-fees/{registrationFee}', [RegistrationFeeController::class, 'destroy'])->name('admin.registration-fees.destroy'); 

// Metirial Fees 
Route::get('/admin/material-fees', [MaterialFeeController::class, 'index'])->name('admin.material-fees.index');
Route::get('/admin/material-fees/create', [MaterialFeeController::class, 'create'])->name('admin.material-fees.create');
Route::post('/admin/material-fees', [MaterialFeeController::class, 'store'])->name('admin.material-fees.store');
Route::get('/admin/material-fees/{materialFee}/edit', [MaterialFeeController::class, 'edit'])->name('admin.material-fees.edit');
Route::put('/admin/material-fees/{materialFee}', [MaterialFeeController::class, 'update'])->name('admin.material-fees.update');
Route::delete('/admin/material-fees/{materialFee}', [MaterialFeeController::class, 'destroy'])->name('admin.material-fees.destroy');

// Branch Registration Fees
Route::get('/admin/branch-registration-fees', [BranchRegistrationFeeController::class, 'index'])->name('admin.branch-registration-fees.index');
Route::get('/admin/branch-registration-fees/create', [BranchRegistrationFeeController::class, 'create'])->name('admin.branch-registration-fees.create');
Route::post('/admin/branch-registration-fees', [BranchRegistrationFeeController::class, 'store'])->name('admin.branch-registration-fees.store');
Route::get('/admin/branch-registration-fees/{branchRegistrationFee}/edit', [BranchRegistrationFeeController::class, 'edit'])->name('admin.branch-registration-fees.edit');
Route::put('/admin/branch-registration-fees/{branchRegistrationFee}', [BranchRegistrationFeeController::class, 'update'])->name('admin.branch-registration-fees.update');
Route::delete('/admin/branch-registration-fees/{branchRegistrationFee}', [BranchRegistrationFeeController::class, 'destroy'])->name('admin.branch-registration-fees.destroy');

// Branch High Season Fees
Route::get('/admin/branch-high-season-fees', [BranchHighSeasonFeeController::class, 'index'])->name('admin.branch-high-season-fees.index');
Route::get('/admin/branch-high-season-fees/create', [BranchHighSeasonFeeController::class, 'create'])->name('admin.branch-high-season-fees.create');
Route::post('/admin/branch-high-season-fees', [BranchHighSeasonFeeController::class, 'store'])->name('admin.branch-high-season-fees.store');
Route::get('/admin/branch-high-season-fees/{branchHighSeasonFee}/edit', [BranchHighSeasonFeeController::class, 'edit'])->name('admin.branch-high-season-fees.edit');
Route::put('/admin/branch-high-season-fees/{branchHighSeasonFee}', [BranchHighSeasonFeeController::class, 'update'])->name('admin.branch-high-season-fees.update');
Route::delete('/admin/branch-high-season-fees/{branchHighSeasonFee}', [BranchHighSeasonFeeController::class, 'destroy'])->name('admin.branch-high-season-fees.destroy');

    Route::get('/course-requirements', [CourseRequirementController::class, 'index'])->name('admin.course-requirements.index');
    Route::get('/course-requirements/create', [CourseRequirementController::class, 'create'])->name('admin.course-requirements.create');
    Route::post('/course-requirements', [CourseRequirementController::class, 'store'])->name('admin.course-requirements.store');
    Route::get('/course-requirements/{course_requirement}', [CourseRequirementController::class, 'show'])->name('admin.course-requirements.show');
    Route::get('/course-requirements/{course_requirement}/edit', [CourseRequirementController::class, 'edit'])->name('admin.course-requirements.edit');
    Route::put('/course-requirements/{course_requirement}', [CourseRequirementController::class, 'update'])->name('admin.course-requirements.update');
    Route::delete('/course-requirements/{course_requirement}', [CourseRequirementController::class, 'destroy'])->name('admin.course-requirements.destroy');

    Route::get('/intakes', [IntakeController::class, 'index'])->name('admin.intakes.index');
    Route::get('/intakes/create', [IntakeController::class, 'create'])->name('admin.intakes.create');
    Route::post('/intakes', [IntakeController::class, 'store'])->name('admin.intakes.store');
    Route::get('/intakes/{intake}', [IntakeController::class, 'show'])->name('admin.intakes.show');
    Route::get('/intakes/{intake}/edit', [IntakeController::class, 'edit'])->name('admin.intakes.edit');
    Route::put('/intakes/{intake}', [IntakeController::class, 'update'])->name('admin.intakes.update');
    Route::delete('/intakes/{intake}', [IntakeController::class, 'destroy'])->name('admin.intakes.destroy');
// Airport Pickups
Route::get('/admin/pickups', [PickupController::class, 'index'])->name('admin.pickups.index');
Route::get('/admin/pickups/create', [PickupController::class, 'create'])->name('admin.pickups.create');
Route::post('/admin/pickups', [PickupController::class, 'store'])->name('admin.pickups.store');
Route::get('/admin/pickups/{pickup}/edit', [PickupController::class, 'edit'])->name('admin.pickups.edit');
Route::put('/admin/pickups/{pickup}', [PickupController::class, 'update'])->name('admin.pickups.update');
Route::delete('/admin/pickups/{pickup}', [PickupController::class, 'destroy'])->name('admin.pickups.destroy');
// Insurance Fees
Route::get('/admin/insurance-fees', [InsuranceFeeController::class, 'index'])->name('admin.insurance-fees.index');
Route::get('/admin/insurance-fees/create', [InsuranceFeeController::class, 'create'])->name('admin.insurance-fees.create');
Route::post('/admin/insurance-fees', [InsuranceFeeController::class, 'store'])->name('admin.insurance-fees.store');
Route::get('/admin/insurance-fees/{insuranceFee}/edit', [InsuranceFeeController::class, 'edit'])->name('admin.insurance-fees.edit');
Route::put('/admin/insurance-fees/{insuranceFee}', [InsuranceFeeController::class, 'update'])->name('admin.insurance-fees.update');
Route::delete('/admin/insurance-fees/{insuranceFee}', [InsuranceFeeController::class, 'destroy'])->name('admin.insurance-fees.destroy');

//Bathrooms
Route::get('/admin/bathrooms', [BathroomController::class, 'index'])->name('admin.bathrooms.index');
Route::get('/admin/bathrooms/create', [BathroomController::class, 'create'])->name('admin.bathrooms.create');
Route::post('/admin/bathrooms', [BathroomController::class, 'store'])->name('admin.bathrooms.store');
Route::get('/admin/bathrooms/{bathroom}/edit', [BathroomController::class, 'edit'])->name('admin.bathrooms.edit');
Route::put('/admin/bathrooms/{bathroom}', [BathroomController::class, 'update'])->name('admin.bathrooms.update');
Route::delete('/admin/bathrooms/{bathroom}', [BathroomController::class, 'destroy'])->name('admin.bathrooms.destroy');

// Bathroom Types
Route::get('/admin/bathroom-types', [BathroomTypeController::class, 'index'])->name('admin.bathroom-types.index');
Route::get('/admin/bathroom-types/create', [BathroomTypeController::class, 'create'])->name('admin.bathroom-types.create');
Route::post('/admin/bathroom-types', [BathroomTypeController::class, 'store'])->name('admin.bathroom-types.store');
Route::get('/admin/bathroom-types/{bathroomType}/edit', [BathroomTypeController::class, 'edit'])->name('admin.bathroom-types.edit');
Route::put('/admin/bathroom-types/{bathroomType}', [BathroomTypeController::class, 'update'])->name('admin.bathroom-types.update');
Route::delete('/admin/bathroom-types/{bathroomType}', [BathroomTypeController::class, 'destroy'])->name('admin.bathroom-types.destroy');

// Bedrooms
Route::get('/admin/bedrooms', [BedroomController::class, 'index'])->name('admin.bedrooms.index');
Route::get('/admin/bedrooms/create', [BedroomController::class, 'create'])->name('admin.bedrooms.create');
Route::post('/admin/bedrooms', [BedroomController::class, 'store'])->name('admin.bedrooms.store');
Route::get('/admin/bedrooms/{bedroom}/edit', [BedroomController::class, 'edit'])->name('admin.bedrooms.edit');
Route::put('/admin/bedrooms/{bedroom}', [BedroomController::class, 'update'])->name('admin.bedrooms.update');
Route::delete('/admin/bedrooms/{bedroom}', [BedroomController::class, 'destroy'])->name('admin.bedrooms.destroy');

// Bedroom Types
Route::get('/admin/bedroom-types', [BedroomTypeController::class, 'index'])->name('admin.bedroom-types.index');
Route::get('/admin/bedroom-types/create', [BedroomTypeController::class, 'create'])->name('admin.bedroom-types.create');
Route::post('/admin/bedroom-types', [BedroomTypeController::class, 'store'])->name('admin.bedroom-types.store');
Route::get('/admin/bedroom-types/{bedroomType}/edit', [BedroomTypeController::class, 'edit'])->name('admin.bedroom-types.edit');
Route::put('/admin/bedroom-types/{bedroomType}', [BedroomTypeController::class, 'update'])->name('admin.bedroom-types.update');
Route::delete('/admin/bedroom-types/{bedroomType}', [BedroomTypeController::class, 'destroy'])->name('admin.bedroom-types.destroy');

// Meals
Route::get('/admin/meals', [MealController::class, 'index'])->name('admin.meals.index');
Route::get('/admin/meals/create', [MealController::class, 'create'])->name('admin.meals.create');
Route::post('/admin/meals', [MealController::class, 'store'])->name('admin.meals.store');
Route::get('/admin/meals/{meal}/edit', [MealController::class, 'edit'])->name('admin.meals.edit');
Route::put('/admin/meals/{meal}', [MealController::class, 'update'])->name('admin.meals.update');
Route::delete('/admin/meals/{meal}', [MealController::class, 'destroy'])->name('admin.meals.destroy');

// Meal Plans
Route::get('/admin/meal-plans', [MealPlanController::class, 'index'])->name('admin.meal-plans.index');
Route::get('/admin/meal-plans/create', [MealPlanController::class, 'create'])->name('admin.meal-plans.create');
Route::post('/admin/meal-plans', [MealPlanController::class, 'store'])->name('admin.meal-plans.store');
Route::get('/admin/meal-plans/{mealPlan}/edit', [MealPlanController::class, 'edit'])->name('admin.meal-plans.edit');
Route::put('/admin/meal-plans/{mealPlan}', [MealPlanController::class, 'update'])->name('admin.meal-plans.update');
Route::delete('/admin/meal-plans/{mealPlan}', [MealPlanController::class, 'destroy'])->name('admin.meal-plans.destroy');

// Accommodations
Route::get('/admin/accommodations', [AccommodationController::class, 'index'])->name('admin.accommodations.index');
Route::get('/admin/accommodations/create', [AccommodationController::class, 'create'])->name('admin.accommodations.create');
Route::post('/admin/accommodations', [AccommodationController::class, 'store'])->name('admin.accommodations.store');
Route::get('/admin/accommodations/{accommodation}/edit', [AccommodationController::class, 'edit'])->name('admin.accommodations.edit');
Route::put('/admin/accommodations/{accommodation}', [AccommodationController::class, 'update'])->name('admin.accommodations.update');
Route::delete('/admin/accommodations/{accommodation}', [AccommodationController::class, 'destroy'])->name('admin.accommodations.destroy');

//supplements 
Route::get('/admin/supplements', [SupplementController::class, 'index'])->name('admin.supplements.index');
Route::get('/admin/supplements/create', [SupplementController::class, 'create'])->name('admin.supplements.create');
Route::post('/admin/supplements', [SupplementController::class, 'store'])->name('admin.supplements.store');
Route::get('/admin/supplements/{supplement}/edit', [SupplementController::class, 'edit'])->name('admin.supplements.edit');
Route::put('/admin/supplements/{supplement}', [SupplementController::class, 'update'])->name('admin.supplements.update');
Route::delete('/admin/supplements/{supplement}', [SupplementController::class, 'destroy'])->name('admin.supplements.destroy');
    
// Discounts
Route::get('/admin/discounts', [DiscountController::class, 'index'])->name('admin.discounts.index');
Route::get('/admin/discounts/create', [DiscountController::class, 'create'])->name('admin.discounts.create');
Route::post('/admin/discounts', [DiscountController::class, 'store'])->name('admin.discounts.store');
Route::get('/admin/discounts/{discount}/edit', [DiscountController::class, 'edit'])->name('admin.discounts.edit');
Route::put('/admin/discounts/{discount}', [DiscountController::class, 'update'])->name('admin.discounts.update');
Route::delete('/admin/discounts/{discount}', [DiscountController::class, 'destroy'])->name('admin.discounts.destroy');
    // Referral Discounts
    Route::get('/referral-discounts', [ReferralDiscountController::class, 'index'])->name('admin.referral-discounts.index');
    Route::get('/referral-discounts/create', [ReferralDiscountController::class, 'create'])->name('admin.referral-discounts.create');
    Route::post('/referral-discounts', [ReferralDiscountController::class, 'store'])->name('admin.referral-discounts.store');
    Route::get('/referral-discounts/{id}/edit', [ReferralDiscountController::class, 'edit'])->name('admin.referral-discounts.edit');
    Route::put('/referral-discounts/{id}', [ReferralDiscountController::class, 'update'])->name('admin.referral-discounts.update');
    Route::delete('/referral-discounts/{id}', [ReferralDiscountController::class, 'destroy'])->name('admin.referral-discounts.destroy');
    // Pioneers Discounts
    Route::get('/pioneers-discounts', [PioneersDiscountController::class, 'index'])->name('admin.pioneers-discounts.index');
    Route::get('/pioneers-discounts/create', [PioneersDiscountController::class, 'create'])->name('admin.pioneers-discounts.create');
    Route::post('/pioneers-discounts', [PioneersDiscountController::class, 'store'])->name('admin.pioneers-discounts.store');
    Route::get('/pioneers-discounts/{pioneersDiscount}/edit', [PioneersDiscountController::class, 'edit'])->name('admin.pioneers-discounts.edit');
    Route::put('/pioneers-discounts/{pioneersDiscount}', [PioneersDiscountController::class, 'update'])->name('admin.pioneers-discounts.update');
    Route::delete('/pioneers-discounts/{pioneersDiscount}', [PioneersDiscountController::class, 'destroy'])->name('admin.pioneers-discounts.destroy');
    // Coupons
// Gallery
Route::get('/admin/gallery', [GalleryController::class, 'index'])->name('admin.gallery.index');
Route::get('/admin/gallery/create', [GalleryController::class, 'create'])->name('admin.gallery.create');
Route::post('/admin/gallery', [GalleryController::class, 'store'])->name('admin.gallery.store');
Route::get('/admin/gallery/{gallery}/edit', [GalleryController::class, 'edit'])->name('admin.gallery.edit');
Route::put('/admin/gallery/{gallery}', [GalleryController::class, 'update'])->name('admin.gallery.update');
Route::delete('/admin/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('admin.gallery.destroy');


// Reviews
Route::get('/admin/reviews', [ReviewController::class, 'index'])->name('admin.reviews.index');
Route::get('/admin/reviews/create', [ReviewController::class, 'create'])->name('admin.reviews.create');
Route::post('/admin/reviews', [ReviewController::class, 'store'])->name('admin.reviews.store');
Route::get('/admin/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('admin.reviews.edit');
Route::put('/admin/reviews/{review}', [ReviewController::class, 'update'])->name('admin.reviews.update');
Route::delete('/admin/reviews/{review}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');

// Blogs
Route::get('/admin/blogs', [BlogController::class, 'index'])->name('admin.blogs.index');
Route::get('/admin/blogs/create', [BlogController::class, 'create'])->name('admin.blogs.create');
Route::post('/admin/blogs', [BlogController::class, 'store'])->name('admin.blogs.store');
Route::get('/admin/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('admin.blogs.edit');
Route::put('/admin/blogs/{blog}', [BlogController::class, 'update'])->name('admin.blogs.update');
Route::delete('/admin/blogs/{blog}', [BlogController::class, 'destroy'])->name('admin.blogs.destroy');

// Categories
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
// Faqs
Route::get('/admin/faqs', [FaqController::class, 'index'])->name('admin.faqs.index');
Route::get('/admin/faqs/create', [FaqController::class, 'create'])->name('admin.faqs.create');
Route::post('/admin/faqs', [FaqController::class, 'store'])->name('admin.faqs.store');
Route::get('/admin/faqs/{faq}/edit', [FaqController::class, 'edit'])->name('admin.faqs.edit');
Route::put('/admin/faqs/{faq}', [FaqController::class, 'update'])->name('admin.faqs.update');
Route::delete('/admin/faqs/{faq}', [FaqController::class, 'destroy'])->name('admin.faqs.destroy');



    // Hart List
    Route::get('/hart-list', [WishListController::class, 'index'])->name('admin.hart-list.index');
    // Users
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/role/{role}', [UserController::class, 'index'])->name('admin.users.role');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::patch('/users/{user}/status', [UserController::class, 'updateStatus'])->name('admin.users.status');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings/branding', [SettingsController::class, 'updateBranding'])->name('admin.settings.branding');
    Route::post('/settings/email-verification', [SettingsController::class, 'updateEmailVerification'])->name('admin.settings.email');
    Route::post('/settings/smtp', [SettingsController::class, 'updateSmtp'])->name('admin.settings.smtp');
    Route::post('/settings/api-clients', [SettingsController::class, 'updateApiClients'])->name('admin.settings.api-clients');
    Route::post('/settings/twilio', [SettingsController::class, 'updateTwilio'])->name('admin.settings.twilio');
    Route::get('/admin/preferred-schools', [PreferredSchoolController::class, 'index'])->name('admin.preferred-schools.index');
    Route::get('/admin/preferred-schools/create', [PreferredSchoolController::class, 'create'])->name('admin.preferred-schools.create');
    Route::post('/admin/preferred-schools', [PreferredSchoolController::class, 'store'])->name('admin.preferred-schools.store');
    Route::get('/admin/preferred-schools/{preferredSchool}/edit', [PreferredSchoolController::class, 'edit'])->name('admin.preferred-schools.edit');
    Route::put('/admin/preferred-schools/{preferredSchool}', [PreferredSchoolController::class, 'update'])->name('admin.preferred-schools.update');
    Route::delete('/admin/preferred-schools/{preferredSchool}', [PreferredSchoolController::class, 'destroy'])->name('admin.preferred-schools.destroy');
    Route::post('/admin/preferred-schools/bulk-update', [PreferredSchoolController::class, 'bulkUpdate'])->name('admin.preferred-schools.bulk-update');

    Route::resource('/universities', UniversityController::class)->names('admin.universities');
    Route::patch('/universities/{university}/restore', [UniversityController::class, 'restore'])->name('admin.universities.restore');

    Route::get('/campuses', [UniversityCampusController::class, 'index'])->name('admin.campuses.index');
    Route::get('/campuses/create', [UniversityCampusController::class, 'create'])->name('admin.campuses.create');
    Route::post('/campuses', [UniversityCampusController::class, 'store'])->name('admin.campuses.store');
    Route::get('/campuses/{university_campus}', [UniversityCampusController::class, 'show'])->name('admin.campuses.show');
    Route::get('/campuses/{university_campus}/edit', [UniversityCampusController::class, 'edit'])->name('admin.campuses.edit');
    Route::put('/campuses/{university_campus}', [UniversityCampusController::class, 'update'])->name('admin.campuses.update');
    Route::delete('/campuses/{university_campus}', [UniversityCampusController::class, 'destroy'])->name('admin.campuses.destroy');
    Route::patch('/campuses/{university_campus}/restore', [UniversityCampusController::class, 'restore'])->name('admin.campuses.restore');

    Route::get('/university-courses', [UniversityCourseController::class, 'index'])->name('admin.university-courses.index');
    Route::get('/university-courses/create', [UniversityCourseController::class, 'create'])->name('admin.university-courses.create');
    Route::post('/university-courses', [UniversityCourseController::class, 'store'])->name('admin.university-courses.store');
    Route::get('/university-courses/{university_course}', [UniversityCourseController::class, 'show'])->name('admin.university-courses.show');
    Route::get('/university-courses/{university_course}/edit', [UniversityCourseController::class, 'edit'])->name('admin.university-courses.edit');
    Route::put('/university-courses/{university_course}', [UniversityCourseController::class, 'update'])->name('admin.university-courses.update');
    Route::delete('/university-courses/{university_course}', [UniversityCourseController::class, 'destroy'])->name('admin.university-courses.destroy');
    Route::patch('/university-courses/{university_course}/restore', [UniversityCourseController::class, 'restore'])->name('admin.university-courses.restore');

    // Agent Referrals
    Route::prefix('/agent-referrals')->group(function () {
        Route::get('/', [AgentReferralController::class, 'index'])->name('admin.referrals.index');
        Route::get('/students', [AgentReferralController::class, 'students'])->name('admin.referrals.students');
        Route::get('/{agent}/edit', [AgentReferralController::class, 'edit'])->name('admin.referrals.edit');
        Route::put('/{agent}', [AgentReferralController::class, 'update'])->name('admin.referrals.update');
    });
    // certifications 
    Route::get('/admin//certifications', [CertificationController::class, 'index'])->name('admin.certifications.index');
    Route::get('/admin//certifications/create', [CertificationController::class, 'create'])->name('admin.certifications.create');
    Route::get('/admin//certifications/{certification}/edit', [CertificationController::class, 'edit'])->name('admin.certifications.edit');
    Route::post('/admin//certifications', [CertificationController::class, 'store'])->name('admin.certifications.store');
    Route::put('/admin//certifications/{certification}', [CertificationController::class, 'update'])->name('admin.certifications.update');
    Route::delete('/admin//certifications/{certification}', [CertificationController::class, 'destroy'])->name('admin.certifications.destroy');

    //exchanges
    Route::post('/get-gbp-all-rates', [ExchangeRateController::class, 'getGbpAllRates'])->name('admin.get-gbp-all-rates');
    Route::get('/fetch-gbp-rates', [ExchangeRateController::class, 'index'])->name('admin.rates.index');
    // convertion fee
    Route::get('/conversion', [ConversionFeeController::class, 'index'])->name('admin.conversion.index');
    Route::post('/conversion', [ConversionFeeController::class, 'store'])->name('admin.conversion.store');
    Route::delete('/conversion/{id}', [ConversionFeeController::class, 'destroy'])->name('admin.conversion.destroy');

    Route::get('/Lang', [TranslationController::class, 'index'])->name('admin.translations.index');
    Route::post('/Lang', [TranslationController::class, 'store'])->name('admin.translations.store');
    Route::put('/Lang/{translation}', [TranslationController::class, 'update'])->name('admin.translations.update');
    Route::delete('/Lang/{translation}', [TranslationController::class, 'destroy'])->name('admin.translations.destroy');

    Route::get('/summer', [SummerController::class, 'index'])->name('admin.summer.index');
    Route::post('/summer', [SummerController::class, 'store'])->name('admin.summer.store');
    Route::put('/summer/{summer}', [SummerController::class, 'update'])->name('admin.summer.update');
    Route::delete('/summer/{summer}', [SummerController::class, 'destroy'])->name('admin.summer.destroy');


});
use App\Http\Controllers\Admin\AgentController;
