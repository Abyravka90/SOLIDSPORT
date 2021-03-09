const input = document.querySelectorAll("[id='kata']");
    for(var i = 0; i < input.length; i++) {
        const awesomplete = new Awesomplete(input[i], {
            minChars: 1
        })
        awesomplete.list = ["ANAN"  ,   "JIIN"  ,   "PASSAI" ,
            "ANAN DAI"  ,   "JION"  ,   "PINAN SHODAN",
            "ANANKO"    ,   "JITTE" ,   "PINAN NIDAN",
            "AOYAGI"    ,   "JYUROKU"   ,   "PINAN SANDAN",
            "BASSAI"    ,   "KANCHIN"   ,   "PINAN YONDAN",
            "BASSAI DAI",   "KANKU DAI" ,   "PINAN GODAN",
            "BASSAI SHO"    ,   "KANKU SHO" ,   "ROHAI",
            "CHATANYARA KUSHANKU"   ,   "KANSHU"    ,   "SAIFA",
            "CHIBANA NO KUSHANKU"   ,   "KISHIMOTO NO KUSHANKU" ,   "SANCHIN",
            "CHINTE"    ,   "KOSOUKUN"  ,   "SANSAI",
            "CHINTO"    ,   "KOSOUKUN DAI"  ,   "SANSEIRU",
            "ENPI"  ,   "KOSOUKUN  SHO" ,   "SANSERU",
            "FUKYGATA ICHI" ,   "KURURUNFA" ,   "SEICHAN",
            "FUKYGATA NI"   ,   "KUSANKU",      "SEIENCHIN (SEIYUNCHIN)",
            "GANKAKU",      "KYAN NO CHINTO",       "SEIPAI",
            "GARYU" ,   "KYAN NO WANSHU",       "SEIRYU",
            "GEKISAI (GEKSAI) ICH",     "MATSUKAZE" ,   "SEISHAN",
            "GEKISAI (GEKSAI) NI"   ,   "MATSUMURA BASSAI",     "SEISAN (SESAN)",
            "GOJUSHIHO" ,   "MATSUMURA ROHAI"   ,   "SHIHO KOUSOUKUN",
            "GOJUSHIHO DAI" ,   "MEIKYO"    ,   "SHINPA",
            "GOJUSHIHO SHO" ,   "MYOJO" ,   "SHINSEI",
            "HAKUCHO"   ,   "NAIFANCHIN SHODAN" ,   "SHISOCHIN",
            "HANGETSU"  ,   "NAIFANCHIN NIDAN"  ,   "SOCHIN",
            "HAUFA (HAFFA)" ,   "NAIFANCHIN SANDAN" ,   "SUPARINPEI",
            "HEIAN SHODAN"  ,   "NAIHANCHIN",       "TEKKI SHODAN",
            "HEIAN NIDAN"   ,   "NIJUSHIHO" ,   "TEKKI NIDAN",
            "HEIAN SANDAN"  ,   "NIPAIPO",      "TEKKI SANDAN",
            "HEIAN YONDAN",     "NISEISHI",     "TENSHO",
            "HEIAN GODAN",      "OHAN",     "TOMARI BASSAI",
            "HEIKU",        "OHAN DAI",     "UNSHU",
            "ISHIMINE BASSAI",      "OYADOMARI NO PASSAI",      "UNSU",
            "ITOSU ROHAI SHODAN",       "PACHU" ,   "USEISHI",
            "ITOSU ROHAI NIDAN" ,   "PAIKU",        "WANKAN",
            "ITOSU ROHAI SANDAN",       "PAPUREN",      "WANSHU",

        ];
        awesomplete.evaluate();
        
    }
