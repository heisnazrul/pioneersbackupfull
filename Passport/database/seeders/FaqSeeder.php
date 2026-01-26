<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
    [
        'category'     => 'Getting Started',
        'ar_category'  => 'البدء',
        'question'     => 'How do I sign up for a Pioneers Educational account?',
        'ar_question'  => 'كيف يمكنني التسجيل للحصول على حساب في Pioneers Educational؟',
        'answer'       => 'It\'s easy! Visit our website, click on "Sign Up," and follow the prompts. You can register with an email or a social media account.',
        'ar_answer'    => 'الأمر سهل! قم بزيارة موقعنا الإلكتروني، وانقر على "Sign Up"، واتبع التعليمات. يمكنك التسجيل باستخدام بريد إلكتروني أو حساب من وسائل التواصل الاجتماعي.',
    ],
    [
        'category'     => 'Getting Started',
        'ar_category'  => 'البدء',
        'question'     => 'Can I access the site from multiple devices?',
        'ar_question'  => 'هل يمكنني الوصول إلى الموقع من عدة أجهزة؟',
        'answer'       => 'Yes, you can log in from multiple devices. Just make sure you have your login details handy, and ensure a stable internet connection for best results.',
        'ar_answer'    => 'نعم، يمكنك تسجيل الدخول من عدة أجهزة. فقط تأكد من أن تفاصيل تسجيل الدخول الخاصة بك في متناول يدك، وتأكد من وجود اتصال إنترنت مستقر للحصول على أفضل النتائج.',
    ],
    [
        'category'     => 'Getting Started',
        'ar_category'  => 'البدء',
        'question'     => 'How do I find and compare different schools or programs?',
        'ar_question'  => 'كيف أجد وأقارن بين المدارس أو البرامج المختلفة؟',
        'answer'       => 'After creating an account, head to the Schools/Programs section. You can filter by location, language, and other preferences to compare your best matches.',
        'ar_answer'    => 'بعد إنشاء حساب، انتقل إلى قسم المدارس/البرامج. يمكنك التصفية حسب الموقع، اللغة، وغيرها من التفضيلات لمقارنة أفضل الخيارات المتاحة لك.',
    ],
    [
        'category'     => 'Getting Started',
        'ar_category'  => 'البدء',
        'question'     => 'Is there a free consultation available?',
        'ar_question'  => 'هل يوجد استشارة مجانية متاحة؟',
        'answer'       => 'We offer a free consultation to help you understand the process. Simply contact our support team to schedule an appointment.',
        'ar_answer'    => 'نحن نقدم استشارة مجانية لمساعدتك على فهم العملية. فقط اتصل بفريق الدعم لدينا لتحديد موعد.',
    ],
    [
        'category'     => 'Pricing',
        'ar_category'  => 'التسعير',
        'question'     => 'How long does the entire admission process usually take?',
        'ar_question'  => 'كم من الوقت يستغرق عادةً عملية القبول بأكملها؟',
        'answer'       => 'This varies by school and program, but typically you’ll receive a response within a few days to a few weeks. We’ll keep you updated throughout the process.',
        'ar_answer'    => 'يختلف ذلك حسب المدرسة والبرنامج، ولكن عادةً ما تتلقى ردًا خلال بضعة أيام إلى بضعة أسابيع. سنبقيك على اطلاع طوال العملية.',
    ],
    [
        'category'     => 'Pricing',
        'ar_category'  => 'التسعير',
        'question'     => 'How does the referral system work?',
        'ar_question'  => 'كيف يعمل نظام الإحالة؟',
        'answer'       => 'Earn rewards when friends or family sign up using your unique referral link and complete a booking. You’ll receive bonuses or discounts toward future courses.',
        'ar_answer'    => 'اكسب مكافآت عندما يقوم الأصدقاء أو أفراد العائلة بالتسجيل باستخدام رابط الإحالة الفريد الخاص بك وإتمام الحجز. ستحصل على مكافآت أو خصومات على الدورات المستقبلية.',
    ],
    [
        'category'     => 'Pricing',
        'ar_category'  => 'التسعير',
        'question'     => 'Are there any hidden fees when booking through Pioneers?',
        'ar_question'  => 'هل توجد أي رسوم خفية عند الحجز من خلال Pioneers؟',
        'answer'       => 'No. We maintain transparency, and all charges will be clearly stated before you confirm your booking.',
        'ar_answer'    => 'لا. نحن نحافظ على الشفافية، وسيتم توضيح جميع الرسوم بوضوح قبل تأكيد الحجز.',
    ],
    [
        'category'     => 'Pricing',
        'ar_category'  => 'التسعير',
        'question'     => 'Do I need to pay upfront for the entire course fee?',
        'ar_question'  => 'هل أحتاج إلى الدفع مقدمًا لكامل رسوم الدورة؟',
        'answer'       => 'Payment policies vary by school. In some cases, a deposit is required, while others may request full payment. We’ll outline the details during checkout.',
        'ar_answer'    => 'تختلف سياسات الدفع حسب المدرسة. في بعض الحالات، يُطلب وديعة، بينما قد تطلب مدارس أخرى الدفع الكامل. سنوضح التفاصيل أثناء عملية الدفع.',
    ],
    [
        'category'     => 'Pricing',
        'ar_category'  => 'التسعير',
        'question'     => 'Is there a discount for group or family bookings?',
        'ar_question'  => 'هل يوجد خصم للحجوزات الجماعية أو العائلية؟',
        'answer'       => 'Yes! We often have group or family discounts. Check the "Promotions" section or contact support for the most up-to-date offers.',
        'ar_answer'    => 'نعم! غالبًا ما نقدم خصومات للمجموعات أو العائلات. تحقق من قسم "العروض" أو اتصل بالدعم للحصول على أحدث العروض.',
    ],
    [
        'category'     => 'Features',
        'ar_category'  => 'الميزات',
        'question'     => 'What is your refund or cancellation policy?',
        'ar_question'  => 'ما هي سياسة الاسترداد أو الإلغاء لديكم؟',
        'answer'       => 'Refunds and cancellations depend on each school’s policy. We recommend reviewing the terms before finalizing payment. If you have questions, reach out to support.',
        'ar_answer'    => 'تعتمد سياسات الاسترداد والإلغاء على سياسة كل مدرسة. نوصي بمراجعة الشروط قبل تأكيد الدفع. إذا كانت لديك أي أسئلة، فاتصل بالدعم.',
    ],
    [
        'category'     => 'Features',
        'ar_category'  => 'الميزات',
        'question'     => 'How do I request a specific language course?',
        'ar_question'  => 'كيف يمكنني طلب دورة لغة معينة؟',
        'answer'       => 'Under "Language Courses," you can filter by language level and duration. Select the one that suits you best and follow the booking instructions.',
        'ar_answer'    => 'ضمن قسم "دورات اللغات"، يمكنك التصفية حسب مستوى اللغة والمدة. اختر الدورة التي تناسبك واتبع تعليمات الحجز.',
    ],
    [
        'category'     => 'Features',
        'ar_category'  => 'الميزات',
        'question'     => 'Can I suggest a course that is not listed?',
        'ar_question'  => 'هل يمكنني اقتراح دورة غير مدرجة؟',
        'answer'       => 'We’re open to expanding our offerings! Use the "Suggest a Course" form, and our team will explore adding it to our catalog.',
        'ar_answer'    => 'نحن منفتحون لتوسيع عروضنا! استخدم نموذج "اقتراح دورة"، وسيتحقق فريقنا من إمكانية إضافتها إلى كتالوجنا.',
    ],
    [
        'category'     => 'Features',
        'ar_category'  => 'الميزات',
        'question'     => 'How do I know if a recommended course is right for me?',
        'ar_question'  => 'كيف أعرف إذا كانت الدورة الموصى بها مناسبة لي؟',
        'answer'       => 'Each course listing includes details such as prerequisites, instructor qualifications, and student reviews to help you make an informed decision.',
        'ar_answer'    => 'تتضمن كل دورة تفاصيل مثل المتطلبات المسبقة، مؤهلات المدرب، وتقييمات الطلاب لمساعدتك في اتخاذ قرار مستنير.',
    ],
    [
        'category'     => 'Features',
        'ar_category'  => 'الميزات',
        'question'     => 'Can I request a course extension or additional materials?',
        'ar_question'  => 'هل يمكنني طلب تمديد الدورة أو مواد إضافية؟',
        'answer'       => 'Yes. Contact your course provider or open a support ticket to discuss extending your current program or acquiring supplementary materials.',
        'ar_answer'    => 'نعم. اتصل بمزود الدورة الخاص بك أو افتح تذكرة دعم لمناقشة تمديد البرنامج الحالي أو الحصول على مواد إضافية.',
    ],
    [
        'category'     => 'Account & Technical Issues',
        'ar_category'  => 'المشاكل التقنية والحساب',
        'question'     => 'How do I see recommended courses based on my interests?',
        'ar_question'  => 'كيف يمكنني رؤية الدورات الموصى بها بناءً على اهتماماتي؟',
        'answer'       => 'After you complete your profile, our platform will suggest courses aligned with your academic background and personal preferences.',
        'ar_answer'    => 'بعد إكمال ملفك الشخصي، ستقترح منصتنا دورات تتماشى مع خلفيتك الأكاديمية وتفضيلاتك الشخصية.',
    ],
    [
        'category'     => 'Account & Technical Issues',
        'ar_category'  => 'المشاكل التقنية والحساب',
        'question'     => 'I forgot my password—how do I reset it?',
        'ar_question'  => 'نسيت كلمة المرور—كيف يمكنني إعادة تعيينها؟',
        'answer'       => 'Click the "Forgot Password" link on the login page and follow the instructions to reset your password. Check your email for a reset link.',
        'ar_answer'    => 'انقر على رابط "نسيت كلمة المرور" في صفحة تسجيل الدخول واتبع التعليمات لإعادة تعيين كلمة المرور. تحقق من بريدك الإلكتروني للحصول على رابط إعادة التعيين.',
    ],
    [
        'category'     => 'Account & Technical Issues',
        'ar_category'  => 'المشاكل التقنية والحساب',
        'question'     => 'My referral link doesn’t seem to work. What should I do?',
        'ar_question'  => 'رابط الإحالة الخاص بي لا يعمل. ماذا يجب أن أفعل؟',
        'answer'       => 'Try clearing your browser cache or using a different device. If issues persist, contact support so we can generate a new link.',
        'ar_answer'    => 'حاول مسح ذاكرة التخزين المؤقتة للمتصفح أو استخدام جهاز مختلف. إذا استمرت المشكلة، فاتصل بالدعم حتى نتمكن من إنشاء رابط جديد.',
    ],
    [
        'category'     => 'Account & Technical Issues',
        'ar_category'  => 'المشاكل التقنية والحساب',
        'question'     => 'Is there a mobile app I can use?',
        'ar_question'  => 'هل يوجد تطبيق جوال يمكنني استخدامه؟',
        'answer'       => 'Our website is mobile-responsive, and we’re developing a dedicated app for iOS and Android. Stay tuned for updates in the coming months!',
        'ar_answer'    => 'موقعنا متجاوب مع الجوال، ونحن بصدد تطوير تطبيق مخصص لنظامي iOS وAndroid. ترقب التحديثات في الأشهر القادمة!',
    ],
    [
        'category'     => 'Account & Technical Issues',
        'ar_category'  => 'المشاكل التقنية والحساب',
        'question'     => 'How do I report a bug or system error?',
        'ar_question'  => 'كيف يمكنني الإبلاغ عن خلل أو خطأ في النظام؟',
        'answer'       => 'Use the "Report an Issue" form under your account settings or contact support directly. Our tech team will address it as soon as possible.',
        'ar_answer'    => 'استخدم نموذج "الإبلاغ عن مشكلة" في إعدادات حسابك أو اتصل بالدعم مباشرة. سيتعامل فريقنا التقني مع الأمر في أسرع وقت ممكن.',
    ],
];


        DB::table('faqs')->insert($faqs);
    }
}
