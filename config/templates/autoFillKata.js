const input = document.querySelectorAll("[id='kata']");
    for(var i = 0; i < input.length; i++) {
        const awesomplete = new Awesomplete(input[i], {
            minChars: 1
        })
        awesomplete.list = ["1. ANAN"  ,   "35. JIIN"  ,   "69. PASSAI" ,
            "2. ANAN DAI"  ,   "36. JION"  ,   "70. PINAN SHODAN",
            "3. ANANKO"    ,   "37. JITTE" ,   "71. PINAN NIDAN",
            "4. AOYAGI"    ,   "38. JYUROKU"   ,   "72. PINAN SANDAN",
            "5. BASSAI"    ,   "39. KANCHIN"   ,   "73. PINAN YONDAN",
            "6. BASSAI DAI",   "40. KANKU DAI" ,   "74. PINAN GODAN",
            "7. BASSAI SHO"    ,   "41. KANKU SHO" ,   "75. ROHAI",
            "8. CHATANYARA KUSHANKU"   ,   "42. KANSHU"    ,   "76. SAIFA",
            "9. CHIBANA NO KUSHANKU"   ,   "43. KISHIMOTO NO KUSHANKU" ,   "77. SANCHIN",
            "10. CHINTE"    ,   "44. KOSOUKUN"  ,   "78. SANSAI",
            "11. CHINTO"    ,   "45. KOSOUKUN DAI"  ,   "79. SANSEIRU",
            "12. ENPI"  ,   "46. KOSOUKUN  SHO" ,   "80. SANSERU",
            "13. FUKYGATA ICHI" ,   "47. KURURUNFA" ,   "81. SEICHAN",
            "14. FUKYGATA NI"   ,   "48. KUSANKU",      "82. SEIENCHIN (SEIYUNCHIN)",
            "15. GANKAKU",      "49. KYAN NO CHINTO",       "83. SEIPAI",
            "16. GARYU" ,   "50. KYAN NO WANSHU",       "84. SEIRYU",
            "17. GEKISAI (GEKSAI) ICH",     "51. MATSUKAZE" ,   "85. SEISHAN",
            "18. GEKISAI (GEKSAI) NI"   ,   "52. MATSUMURA BASSAI",     "86. SEISAN (SESAN)",
            "19. GOJUSHIHO" ,   "53. MATSUMURA ROHAI"   ,   "87. SHIHO KOUSOUKUN",
            "20. GOJUSHIHO DAI" ,   "54. MEIKYO"    ,   "88. SHINPA",
            "21. GOJUSHIHO SHO" ,   "55. MYOJO" ,   "89. SHINSEI",
            "22. HAKUCHO"   ,   "56. NAIFANCHIN SHODAN" ,   "90. SHISOCHIN",
            "23. HANGETSU"  ,   "57. NAIFANCHIN NIDAN"  ,   "91. SOCHIN",
            "24. HAUFA (HAFFA)" ,   "58. NAIFANCHIN SANDAN" ,   "92. SUPARINPEI",
            "25. HEIAN SHODAN"  ,   "59. NAIHANCHIN",       "93. TEKKI SHODAN",
            "26. HEIAN NIDAN"   ,   "60. NIJUSHIHO" ,   "94. TEKKI NIDAN",
            "27. HEIAN SANDAN"  ,   "61. NIPAIPO",      "95. TEKKI SANDAN",
            "28. HEIAN YONDAN",     "62. NISEISHI",     "96. TENSHO",
            "29. HEIAN GODAN",      "63. OHAN",     "97. TOMARI BASSAI",
            "30. HEIKU",        "64. OHAN DAI",     "98. UNSHU",
            "31. ISHIMINE BASSAI",      "65. OYADOMARI NO PASSAI",      "99. UNSU",
            "32. ITOSU ROHAI SHODAN",       "66. PACHU" ,   "100. USEISHI",
            "33. ITOSU ROHAI NIDAN" ,   "67. PAIKU",        "101. WANKAN",
            "34. ITOSU ROHAI SANDAN",       "68. PAPUREN",      "102. WANSHU",

        ];
        awesomplete.evaluate();
        
    }
