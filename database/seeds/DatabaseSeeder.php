<?php

use App\Models\Country;
use App\Models\CountryTranslation;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use PHPUnit\Framework\Constraint\Count;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->seedBranchPermissions();
        $this->seedContactsPermissions();
        $this->seedUploiadedFilesPermissions();

        $this->seedCountries();
    }




    /**
     *    Seed Banches Permissions and middlewares.
     */
    public function  seedBranchPermissions()
    {
        $contact_permissions    =   ['view_branch' ,  'create_branch' ,    'update_branch' , 'delete_branch'];
        foreach($contact_permissions as $contact_permission)
        {
            $permission =   [
                'name'                   =>  $contact_permission,
                'section'                =>  'Branches',
                'guard_name'             =>  'web',
            ];
            Permission::query()->updateOrCreate($permission , $permission);
        }
    }

    /**
     * Seed Cotnact Permissions
     */
    public function seedContactsPermissions()
    {
        $contact_permissions    =   ['view_contacts' , 'edit_contacts'];
        foreach($contact_permissions as $contact_permission)
        {
            $permission =   [
                'name'      =>  $contact_permission,
                'section'   =>  'Contact Messages',
                'guard_name'     =>  'web',
            ];
            Permission::query()->updateOrCreate($permission , $permission);
        }
    }


    /**
     * Seed Cotnact Permissions
     */
    public function seedUploiadedFilesPermissions()
    {
        $contact_permissions    =   ['view_uploaded_files'];
        foreach($contact_permissions as $contact_permission)
        {
            $permission =   [
                'name'      =>  $contact_permission,
                'section'   =>  'Uploaded Files',
                'guard_name'     =>  'web',
            ];
            Permission::query()->updateOrCreate($permission , $permission);
        }
    }



    // Seed Countries
    public function seedCountries()
    {
        $countries = array(
            'Afghanistan' => 'AF',
            'Albania' => 'AL',
            'Algeria' => 'DZ',
            'Andorra' => 'AD',
            'Angola' => 'AO',
            'Antigua and Barbuda' => 'AG',
            'Argentina' => 'AR',
            'Armenia' => 'AM',
            'Australia' => 'AU',
            'Austria' => 'AT',
            'Azerbaijan' => 'AZ',
            'Bahamas' => 'BS',
            'Bahrain' => 'BH',
            'Bangladesh' => 'BD',
            'Barbados' => 'BB',
            'Belarus' => 'BY',
            'Belgium' => 'BE',
            'Belize' => 'BZ',
            'Benin' => 'BJ',
            'Bhutan' => 'BT',
            'Bolivia' => 'BO',
            'Bosnia and Herzegovina' => 'BA',
            'Botswana' => 'BW',
            'Brazil' => 'BR',
            'Brunei' => 'BN',
            'Bulgaria' => 'BG',
            'Burkina Faso' => 'BF',
            'Burundi' => 'BI',
            'Cabo Verde' => 'CV',
            'Cambodia' => 'KH',
            'Cameroon' => 'CM',
            'Canada' => 'CA',
            'Central African Republic' => 'CF',
            'Chad' => 'TD',
            'Chile' => 'CL',
            'China' => 'CN',
            'Colombia' => 'CO',
            'Comoros' => 'KM',
            'Congo (Congo-Brazzaville)' => 'CG',
            'Costa Rica' => 'CR',
            'Croatia' => 'HR',
            'Cuba' => 'CU',
            'Cyprus' => 'CY',
            'Czechia (Czech Republic)' => 'CZ',
            'Democratic Republic of the Congo' => 'CD',
            'Denmark' => 'DK',
            'Djibouti' => 'DJ',
            'Dominica' => 'DM',
            'Dominican Republic' => 'DO',
            'Ecuador' => 'EC',
            'Egypt' => 'EG',
            'El Salvador' => 'SV',
            'Equatorial Guinea' => 'GQ',
            'Eritrea' => 'ER',
            'Estonia' => 'EE',
            'Eswatini (fmr. "Swaziland")' => 'SZ',
            'Ethiopia' => 'ET',
            'Fiji' => 'FJ',
            'Finland' => 'FI',
            'France' => 'FR',
            'Gabon' => 'GA',
            'Gambia' => 'GM',
            'Georgia' => 'GE',
            'Germany' => 'DE',
            'Ghana' => 'GH',
            'Greece' => 'GR',
            'Grenada' => 'GD',
            'Guatemala' => 'GT',
            'Guinea' => 'GN',
            'Guinea-Bissau' => 'GW',
            'Guyana' => 'GY',
            'Haiti' => 'HT',
            'Holy See' => 'VA',
            'Honduras' => 'HN',
            'Hungary' => 'HU',
            'Iceland' => 'IS',
            'India' => 'IN',
            'Indonesia' => 'ID',
            'Iran' => 'IR',
            'Iraq' => 'IQ',
            'Ireland' => 'IE',
            'Israel' => 'IL',
            'Italy' => 'IT',
            'Jamaica' => 'JM',
            'Japan' => 'JP',
            'Jordan' => 'JO',
            'Kazakhstan' => 'KZ',
            'Kenya' => 'KE',
            'Kiribati' => 'KI',
            'Kuwait' => 'KW',
            'Kyrgyzstan' => 'KG',
            'Laos' => 'LA',
            'Latvia' => 'LV',
            'Lebanon' => 'LB',
            'Lesotho' => 'LS',
            'Liberia' => 'LR',
            'Libya' => 'LY',
            'Liechtenstein' => 'LI',
            'Lithuania' => 'LT',
            'Luxembourg' => 'LU',
            'Madagascar' => 'MG',
            'Malawi' => 'MW',
            'Malaysia' => 'MY',
            'Maldives' => 'MV',
            'Mali' => 'ML',
            'Malta' => 'MT',
            'Marshall Islands' => 'MH',
            'Mauritania' => 'MR',
            'Mauritius' => 'MU',
            'Mexico' => 'MX',
            'Micronesia' => 'FM',
            'Moldova' => 'MD',
            'Monaco' => 'MC',
            'Mongolia' => 'MN',
            'Montenegro' => 'ME',
            'Morocco' => 'MA',
            'Mozambique' => 'MZ',
            'Myanmar (formerly Burma)' => 'MM',
            'Namibia' => 'NA',
            'Nauru' => 'NR',
            'Nepal' => 'NP',
            'Netherlands' => 'NL',
            'New Zealand' => 'NZ',
            'Nicaragua' => 'NI',
            'Niger' => 'NE',
            'Nigeria' => 'NG',
            'North Korea' => 'KP',
            'North Macedonia (formerly Macedonia)' => 'MK',
            'Norway' => 'NO',
            'Oman' => 'OM',
            'Pakistan' => 'PK',
            'Palau' => 'PW',
            'Palestine State' => 'PS',
            'Panama' => 'PA',
            'Papua New Guinea' => 'PG',
            'Paraguay' => 'PY',
            'Peru' => 'PE',
            'Philippines' => 'PH',
            'Poland' => 'PL',
            'Portugal' => 'PT',
            'Qatar' => 'QA',
            'Romania' => 'RO',
            'Russia' => 'RU',
            'Rwanda' => 'RW',
            'Saint Kitts and Nevis' => 'KN',
            'Saint Lucia' => 'LC',
            'Saint Vincent and the Grenadines' => 'VC',
            'Samoa' => 'WS',
            'San Marino' => 'SM',
            'Sao Tome and Principe' => 'ST',
            'Saudi Arabia' => 'SA',
            'Senegal' => 'SN',
            'Serbia' => 'RS',
            'Seychelles' => 'SC',
            'Sierra Leone' => 'SL',
            'Singapore' => 'SG',
            'Slovakia' => 'SK',
            'Slovenia' => 'SI',
            'Solomon Islands' => 'SB',
            'Somalia' => 'SO',
            'South Africa' => 'ZA',
            'South Korea' => 'KR',
            'South Sudan' => 'SS',
            'Spain' => 'ES',
            'Sri Lanka' => 'LK',
            'Sudan' => 'SD',
            'Suriname' => 'SR',
            'Sweden' => 'SE',
            'Switzerland' => 'CH',
            'Syria' => 'SY',
            'Tajikistan' => 'TJ',
            'Tanzania' => 'TZ',
            'Thailand' => 'TH',
            'Timor-Leste' => 'TL',
            'Togo' => 'TG',
            'Tonga' => 'TO',
            'Trinidad and Tobago' => 'TT',
            'Tunisia' => 'TN',
            'Turkey' => 'TR',
            'Turkmenistan' => 'TM',
            'Tuvalu' => 'TV',
            'Uganda' => 'UG',
            'Ukraine' => 'UA',
            'United Arab Emirates' => 'AE',
            'United Kingdom' => 'GB',
            'United States of America' => 'US',
            'Uruguay' => 'UY',
            'Uzbekistan' => 'UZ',
            'Vanuatu' => 'VU',
            'Venezuela' => 'VE',
            'Vietnam' => 'VN',
            'Yemen' => 'YE',
            'Zambia' => 'ZM',
            'Zimbabwe' => 'ZW',
        );
        foreach($countries as $name => $code)
        {
            $country =  [
                'name'  =>  $name,
                'code'  =>  $code,
            ];
            Country::query()->updateOrCreate($country , $country);
        }
        $countries_ar = array(
            'أفغانستان' => 'AF',
            'ألبانيا' => 'AL',
            'الجزائر' => 'DZ',
            'أندورا' => 'AD',
            'أنغولا' => 'AO',
            'أنتيغوا وبربودا' => 'AG',
            'الأرجنتين' => 'AR',
            'أرمينيا' => 'AM',
            'أستراليا' => 'AU',
            'النمسا' => 'AT',
            'أذربيجان' => 'AZ',
            'البهاما' => 'BS',
            'البحرين' => 'BH',
            'بنغلاديش' => 'BD',
            'باربادوس' => 'BB',
            'روسيا البيضاء' => 'BY',
            'بلجيكا' => 'BE',
            'بليز' => 'BZ',
            'بنين' => 'BJ',
            'بوتان' => 'BT',
            'بوليفيا' => 'BO',
            'البوسنة والهرسك' => 'BA',
            'بوتسوانا' => 'BW',
            'البرازيل' => 'BR',
            'بروناي' => 'BN',
            'بلغاريا' => 'BG',
            'بوركينا فاسو' => 'BF',
            'بوروندي' => 'BI',
            'الكابو فيردي' => 'CV',
            'كمبوديا' => 'KH',
            'الكاميرون' => 'CM',
            'كندا' => 'CA',
            'جمهورية أفريقيا الوسطى' => 'CF',
            'تشاد' => 'TD',
            'تشيلي' => 'CL',
            'الصين' => 'CN',
            'كولومبيا' => 'CO',
            'جزر القمر' => 'KM',
            'جمهورية الكونغو' => 'CG',
            'كوستاريكا' => 'CR',
            'كرواتيا' => 'HR',
            'كوبا' => 'CU',
            'قبرص' => 'CY',
            'جمهورية التشيك' => 'CZ',
            'جمهورية الكونغو الديمقراطية' => 'CD',
            'الدنمارك' => 'DK',
            'جيبوتي' => 'DJ',
            'دومينيكا' => 'DM',
            'جمهورية الدومينيكان' => 'DO',
            'الإكوادور' => 'EC',
            'مصر' => 'EG',
            'السلفادور' => 'SV',
            'غينيا الاستوائية' => 'GQ',
            'إريتريا' => 'ER',
            'إستونيا' => 'EE',
            'سوازيلاند' => 'SZ',
            'إثيوبيا' => 'ET',
            'فيجي' => 'FJ',
            'فنلندا' => 'FI',
            'فرنسا' => 'FR',
            'الغابون' => 'GA',
            'غامبيا' => 'GM',
            'جورجيا' => 'GE',
            'ألمانيا' => 'DE',
            'غانا' => 'GH',
            'اليونان' => 'GR',
            'جرينادا' => 'GD',
            'غواتيمالا' => 'GT',
            'غينيا' => 'GN',
            'غينيا بيساو' => 'GW',
            'غيانا' => 'GY',
            'هايتي' => 'HT',
            'هولي See' => 'VA',
            'هندوراس' => 'HN',
            'المجر' => 'HU',
            'آيسلندا' => 'IS',
            'الهند' => 'IN',
            'إندونيسيا' => 'ID',
            'إيران' => 'IR',
            'العراق' => 'IQ',
            'أيرلندا' => 'IE',
            'إسرائيل' => 'IL',
            'إيطاليا' => 'IT',
            'جامايكا' => 'JM',
            'اليابان' => 'JP',
            'الأردن' => 'JO',
            'كازاخستان' => 'KZ',
            'كينيا' => 'KE',
            'كيريباتي' => 'KI',
            'الكويت' => 'KW',
            'قرغيزستان' => 'KG',
            'لاوس' => 'LA',
            'لاتفيا' => 'LV',
            'لبنان' => 'LB',
            'ليسوتو' => 'LS',
            'ليبيريا' => 'LR',
            'ليبيا' => 'LY',
            'ليختنشتاين' => 'LI',
            'ليتوانيا' => 'LT',
            'لوكسمبورغ' => 'LU',
            'مدغشقر' => 'MG',
            'مالاوي' => 'MW',
            'ماليزيا' => 'MY',
            'جزر المالديف' => 'MV',
            'مالي' => 'ML',
            'مالطا' => 'MT',
            'جزر مارشال' => 'MH',
            'موريتانيا' => 'MR',
            'موريشيوس' => 'MU',
            'المكسيك' => 'MX',
            'ميكرونيزيا' => 'FM',
            'مولدوفا' => 'MD',
            'موناكو' => 'MC',
            'منغوليا' => 'MN',
            'الجبل الأسود' => 'ME',
            'المغرب' => 'MA',
            'موزمبيق' => 'MZ',
            'ميانمار' => 'MM',
            'ناميبيا' => 'NA',
            'ناورو' => 'NR',
            'نيبال' => 'NP',
            'هولندا' => 'NL',
            'نيوزيلندا' => 'NZ',
            'نيكاراجوا' => 'NI',
            'النيجر' => 'NE',
            'نيجيريا' => 'NG',
            'كوريا الشمالية' => 'KP',
            'مقدونيا الشمالية' => 'MK',
            'النرويج' => 'NO',
            'سلطنة عمان' => 'OM',
            'باكستان' => 'PK',
            'بالاو' => 'PW',
            'دولة فلسطين' => 'PS',
            'بنما' => 'PA',
            'بابوا غينيا الجديدة' => 'PG',
            'باراغواي' => 'PY',
            'بيرو' => 'PE',
            'الفلبين' => 'PH',
            'بولندا' => 'PL',
            'البرتغال' => 'PT',
            'قطر' => 'QA',
            'رومانيا' => 'RO',
            'روسيا' => 'RU',
            'رواندا' => 'RW',
            'سانت كيتس ونيفيس' => 'KN',
            'سانت لوسيا' => 'LC',
            'سانت فينسنت والغرنادين' => 'VC',
            'ساموا' => 'WS',
            'سان مارينو' => 'SM',
            'ساو تومي وبرينسيبي' => 'ST',
            'المملكة العربية السعودية' => 'SA',
            'السنغال' => 'SN',
            'صربيا' => 'RS',
            'سيشيل' => 'SC',
            'سيراليون' => 'SL',
            'سنغافورة' => 'SG',
            'سلوفاكيا' => 'SK',
            'سلوفينيا' => 'SI',
            'جزر سليمان' => 'SB',
            'الصومال' => 'SO',
            'جنوب أفريقيا' => 'ZA',
            'كوريا الجنوبية' => 'KR',
            'جنوب السودان' => 'SS',
            'إسبانيا' => 'ES',
            'سريلانكا' => 'LK',
            'السودان' => 'SD',
            'سوريا' => 'SY',
            'طاجيكستان' => 'TJ',
            'تنزانيا' => 'TZ',
            'تايلاند' => 'TH',
            'تيمور الشرقية' => 'TL',
            'توغو' => 'TG',
            'تونغا' => 'TO',
            'ترينيداد وتوباغو' => 'TT',
            'تونس' => 'TN',
            'تركيا' => 'TR',
            'تركمانستان' => 'TM',
            'توفالو' => 'TV',
            'أوغندا' => 'UG',
            'أوكرانيا' => 'UA',
            'الإمارات العربية المتحدة' => 'AE',
            'المملكة المتحدة' => 'GB',
            'الولايات المتحدة الأمريكية' => 'US',
            'أوروغواي' => 'UY',
            'أوزبكستان' => 'UZ',
            'فانواتو' => 'VU',
            'فنزويلا' => 'VE',
            'فيتنام' => 'VN',
            'اليمن' => 'YE',
            'زامبيا' => 'ZM',
            'زيمبابوي' => 'ZW',
        );
        $langs      =   [
            'sa',
            'en'
        ];
            foreach($countries_ar as $name => $code)
            {
                $country            =   Country::query()->where('code' , $code)->first();

                $country_data       =  [
                    'name'                  =>  $name,
                    'lang'                  =>  'sa',
                    'country_id'            =>  $country->id
                ];
                CountryTranslation::query()->updateOrCreate([
                    'country_id'        =>  $country->id,
                    'lang'              =>  'sa',
                ],
                $country_data
            );
            }
            foreach($countries as $name => $code)
            {
                $country            =   Country::query()->where('code' , $code)->first();

                $country_data       =  [
                    'name'                  =>  $name,
                    'lang'                  =>  'en',
                    'country_id'            =>  $country->id
                ];
                CountryTranslation::query()->updateOrCreate([
                    'country_id'        =>  $country->id,
                    'lang'              =>  'en',
                ],
                $country_data
            );
            }
    }
}
