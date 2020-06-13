<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->string('native');
            $table->tinyInteger('rtl');
            $table->timestamps();


            $table->integer('school_id')->nullable()->default(1)->unsigned();
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('restrict');  
        });

        DB::statement("INSERT INTO languages (id, code, name, native, rtl) VALUES
            (1, 'af', 'Afrikaans', 'Afrikaans', 0),
            (2, 'am', 'Amharic', 'አማርኛ', 0),
            (3, 'ar', 'Arabic', 'العربية', 1),
            (4, 'ay', 'Aymara', 'Aymar', 0),
            (5, 'az', 'Azerbaijani', 'Azərbaycanca / آذربايجان', 0),
            (6, 'be', 'Belarusian', 'Беларуская', 0),
            (7, 'bg', 'Bulgarian', 'Български', 0),
            (8, 'bi', 'Bislama', 'Bislama', 0),
            (9, 'bn', 'Bengali', 'বাংলা', 0),
            (10, 'bs', 'Bosnian', 'Bosanski', 0),
            (11, 'ca', 'Catalan', 'Català', 0),
            (12, 'ch', 'Chamorro', 'Chamoru', 0),
            (13, 'cs', 'Czech', 'Česky', 0),
            (14, 'da', 'Danish', 'Dansk', 0),
            (15, 'de', 'German', 'Deutsch', 0),
            (16, 'dv', 'Divehi', 'ދިވެހިބަސް', 1),
            (17, 'dz', 'Dzongkha', 'ཇོང་ཁ', 0),
            (18, 'el', 'Greek', 'Ελληνικά', 0),
            (19, 'en', 'English', 'English', 0),
            (20, 'es', 'Spanish', 'Español', 0),
            (21, 'et', 'Estonian', 'Eesti', 0),
            (22, 'eu', 'Basque', 'Euskara', 0),
            (23, 'fa', 'Persian', 'فارسی', 1),
            (24, 'ff', 'Peul', 'Fulfulde', 0),
            (25, 'fi', 'Finnish', 'Suomi', 0),
            (26, 'fj', 'Fijian', 'Na Vosa Vakaviti', 0),
            (27, 'fo', 'Faroese', 'Føroyskt', 0),
            (28, 'fr', 'French', 'Français', 0),
            (29, 'ga', 'Irish', 'Gaeilge', 0),
            (30, 'gl', 'Galician', 'Galego', 0),
            (31, 'gn', 'Guarani', 'Avañe\'ẽ', 0),
            (32, 'gv', 'Manx', 'Gaelg', 0),
            (33, 'he', 'Hebrew', 'עברית', 1),
            (34, 'hi', 'Hindi', 'हिन्दी', 0),
            (35, 'hr', 'Croatian', 'Hrvatski', 0),
            (36, 'ht', 'Haitian', 'Krèyol ayisyen', 0),
            (37, 'hu', 'Hungarian', 'Magyar', 0),
            (38, 'hy', 'Armenian', 'Հայերեն', 0),
            (39, 'id', 'Indonesian', 'Bahasa Indonesia', 0),
            (40, 'is', 'Icelandic', 'Íslenska', 0),
            (41, 'it', 'Italian', 'Italiano', 0),
            (42, 'ja', 'Japanese', '日本語', 0),
            (43, 'ka', 'Georgian', 'ქართული', 0),
            (44, 'kg', 'Kongo', 'KiKongo', 0),
            (45, 'kk', 'Kazakh', 'Қазақша', 0),
            (46, 'kl', 'Greenlandic', 'Kalaallisut', 0),
            (47, 'km', 'Cambodian', 'ភាសាខ្មែរ', 0),
            (48, 'ko', 'Korean', '한국어', 0),
            (49, 'ku', 'Kurdish', 'Kurdî / كوردی', 1),
            (50, 'ky', 'Kirghiz', 'Kırgızca / Кыргызча', 0),
            (51, 'la', 'Latin', 'Latina', 0),
            (52, 'lb', 'Luxembourgish', 'Lëtzebuergesch', 0),
            (53, 'ln', 'Lingala', 'Lingála', 0),
            (54, 'lo', 'Laotian', 'ລາວ / Pha xa lao', 0),
            (55, 'lt', 'Lithuanian', 'Lietuvių', 0),
            (56, 'lu', '', '', 0),
            (57, 'lv', 'Latvian', 'Latviešu', 0),
            (58, 'mg', 'Malagasy', 'Malagasy', 0),
            (59, 'mh', 'Marshallese', 'Kajin Majel / Ebon', 0),
            (60, 'mi', 'Maori', 'Māori', 0),
            (61, 'mk', 'Macedonian', 'Македонски', 0),
            (62, 'mn', 'Mongolian', 'Монгол', 0),
            (63, 'ms', 'Malay', 'Bahasa Melayu', 0),
            (64, 'mt', 'Maltese', 'bil-Malti', 0),
            (65, 'my', 'Burmese', 'မြန်မာစာ', 0),
            (66, 'na', 'Nauruan', 'Dorerin Naoero', 0),
            (67, 'nb', '', '', 0),
            (68, 'nd', 'North Ndebele', 'Sindebele', 0),
            (69, 'ne', 'Nepali', 'नेपाली', 0),
            (70, 'nl', 'Dutch', 'Nederlands', 0),
            (71, 'nn', 'Norwegian Nynorsk', 'Norsk (nynorsk)', 0),
            (72, 'no', 'Norwegian', 'Norsk (bokmål / riksmål)', 0),
            (73, 'nr', 'South Ndebele', 'isiNdebele', 0),
            (74, 'ny', 'Chichewa', 'Chi-Chewa', 0),
            (75, 'oc', 'Occitan', 'Occitan', 0),
            (76, 'pa', 'Panjabi / Punjabi', 'ਪੰਜਾਬੀ / पंजाबी / پنجابي', 0),
            (77, 'pl', 'Polish', 'Polski', 0),
            (78, 'ps', 'Pashto', 'پښتو', 1),
            (79, 'pt', 'Portuguese', 'Português', 0),
            (80, 'qu', 'Quechua', 'Runa Simi', 0),
            (81, 'rn', 'Kirundi', 'Kirundi', 0),
            (82, 'ro', 'Romanian', 'Română', 0),
            (83, 'ru', 'Russian', 'Русский', 0),
            (84, 'rw', 'Rwandi', 'Kinyarwandi', 0),
            (85, 'sg', 'Sango', 'Sängö', 0),
            (86, 'si', 'Sinhalese', 'සිංහල', 0),
            (87, 'sk', 'Slovak', 'Slovenčina', 0),
            (88, 'sl', 'Slovenian', 'Slovenščina', 0),
            (89, 'sm', 'Samoan', 'Gagana Samoa', 0),
            (90, 'sn', 'Shona', 'chiShona', 0),
            (91, 'so', 'Somalia', 'Soomaaliga', 0),
            (92, 'sq', 'Albanian', 'Shqip', 0),
            (93, 'sr', 'Serbian', 'Српски', 0),
            (94, 'ss', 'Swati', 'SiSwati', 0),
            (95, 'st', 'Southern Sotho', 'Sesotho', 0),
            (96, 'sv', 'Swedish', 'Svenska', 0),
            (97, 'sw', 'Swahili', 'Kiswahili', 0),
            (98, 'ta', 'Tamil', 'தமிழ்', 0),
            (99, 'tg', 'Tajik', 'Тоҷикӣ', 0),
            (100, 'th', 'Thai', 'ไทย / Phasa Thai', 0),
            (101, 'ti', 'Tigrinya', 'ትግርኛ', 0),
            (102, 'tk', 'Turkmen', 'Туркмен / تركمن', 0),
            (103, 'tn', 'Tswana', 'Setswana', 0),
            (104, 'to', 'Tonga', 'Lea Faka-Tonga', 0),
            (105, 'tr', 'Turkish', 'Türkçe', 0),
            (106, 'ts', 'Tsonga', 'Xitsonga', 0),
            (107, 'uk', 'Ukrainian', 'Українська', 0),
            (108, 'ur', 'Urdu', 'اردو', 1),
            (109, 'uz', 'Uzbek', 'Ўзбек', 0),
            (110, 've', 'Venda', 'Tshivenḓa', 0),
            (111, 'vi', 'Vietnamese', 'Tiếng Việt', 0),
            (112, 'xh', 'Xhosa', 'isiXhosa', 0),
            (113, 'zh', 'Chinese', '中文', 0),
            (114, 'zu', 'Zulu', 'isiZulu', 0)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
