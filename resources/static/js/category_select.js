//地区选择文件  创建时间 2016-08-12 16:48:27//调用方法示例
//1、 HXDialogCate.setup({inputField:'cid',displayField:'cname'});
//2、 category_select_create('areaid', 'areaname');

var HXDialogCateCount = 0, HXDialogCateExpando = new Date() - 0;
//        var HXDialogCateLList = [["0", "\u641c\u7d22\u7c7b\u522b"], ["104", "\u5b66\u4e60\u8f85\u5bfc"], ["6", "\u6587\u4f53\u827a\u672f"], ["2", "\u8bed\u8a00\u57f9\u8bad"], ["1", "\u7535\u8111\u4e0eIT"], ["3", "\u804c\u4e1a\u6280\u80fd"], ["5", "\u8d44\u683c\u8003\u8bd5"], ["4", "\u4f01\u4e1a\u7ba1\u7406"], ["93", "\u5b66\u5386\u6587\u51ed"], ["105", "\u51fa\u56fd\u7559\u5b66"], ["655", "\u8fdc\u7a0b\u6559\u80b2"]];
//        var HXDialogCate0LIST = {"104":["104", "\u5b66\u4e60\u8f85\u5bfc"], "6":["6", "\u6587\u4f53\u827a\u672f"], "2":["2", "\u8bed\u8a00\u57f9\u8bad"], "1":["1", "\u7535\u8111\u4e0eIT"], "3":["3", "\u804c\u4e1a\u6280\u80fd"], "5":["5", "\u8d44\u683c\u8003\u8bd5"], "4":["4", "\u4f01\u4e1a\u7ba1\u7406"], "93":["93", "\u5b66\u5386\u6587\u51ed"], "105":["105", "\u51fa\u56fd\u7559\u5b66"], "655":["655", "\u8fdc\u7a0b\u6559\u80b2"]};
//        var HXDialogCate1LIST = {"2":{"483":["483", "\u82f1\u8bed"], "485":["485", "\u6c49\u8bed"], "484":["484", "\u5c0f\u8bed\u79cd"]}, "1":{"486":["486", "\u529e\u516c\u5e94\u7528"], "487":["487", "\u8f6f\u4ef6\u7cfb\u7edf"], "488":["488", "\u5f71\u89c6\u52a8\u6f2b"], "575":["575", "\u8bbe\u8ba1\u5e08"], "489":["489", "\u7535\u5b50\u8425\u9500"], "576":["576", "\u8f6f\u4ef6\u5236\u56fe"], "490":["490", "IT\u8ba4\u8bc1"]}, "3":{"491":["491", "\u9a7e\u9a76"], "492":["492", "\u4e2d\u897f\u9910\u996e"], "493":["493", "\u7f8e\u5bb9\u5316\u5986"], "494":["494", "\u670d\u88c5\u7a7f\u6234"], "495":["495", "\u64ad\u97f3\u4e3b\u6301"], "496":["496", "\u7ef4\u4fee\u7ef4\u62a4"], "497":["497", "\u6570\u63a7\u673a\u68b0"], "616":["616", "\u6c7d\u8f66\u6539\u88c5"], "498":["498", "\u521b\u4e1a\u624b\u827a"]}, "5":{"499":["499", "\u4f1a\u8ba1"], "500":["500", "\u91d1\u878d"], "502":["502", "\u533b\u836f"], "504":["504", "\u5efa\u7b51"], "567":["567", "\u6536\u85cf"], "503":["503", "\u5916\u8d38"], "501":["501", "\u56fd\u5bb6\u516c\u804c"], "506":["506", "\u804c\u79f0\u8003\u8bc1"], "505":["505", "\u623f\u4ea7\u89c4\u5212"], "507":["507", "\u5176\u4ed6\u804c\u4e1a\u8d44\u683c"]}, "4":{"508":["508", "\u9ad8\u5c42\u7ba1\u7406"], "509":["509", "\u4e2d\u5c42\u7ba1\u7406"], "510":["510", "\u5458\u5de5\u57f9\u8bad"], "511":["511", "\u5176\u4ed6\u7ba1\u7406\u57f9\u8bad"]}, "6":{"512":["512", "\u4e66\u753b"], "513":["513", "\u97f3\u4e50"], "514":["514", "\u821e\u8e48"], "515":["515", "\u68cb\u7c7b"], "516":["516", "\u7403\u7c7b"], "517":["517", "\u7231\u597d"]}, "104":{"525":["525", "\u62d3\u5c55\u8bad\u7ec3\u8425"], "526":["526", "\u4e2d\u5c0f\u5b66\u6559\u80b2"], "519":["519", "\u4e2d\u5c0f\u5b66\u8bfe\u5916\u8f85\u5bfc"], "523":["523", "\u5e7c\u513f\u65e9\u671f\u6559\u80b2"], "590":["590", "\u56fd\u9645\u6559\u80b2"], "520":["520", "\u9ad8\u8003\u827a\u8003\u8f85\u5bfc"], "522":["522", "\u4f53\u80b2\u8f85\u5bfc"]}, "93":{"527":["527", "\u7edf\u62db\u9662\u6821"], "528":["528", "\u6210\u4eba\u5b66\u5386"], "529":["529", "\u8003\u7814\u8003\u535a"]}, "105":{"533":["533", "\u4e9a\u6d32\u7559\u5b66"], "530":["530", "\u7f8e\u6d32\u7559\u5b66"], "531":["531", "\u6b27\u6d32\u7559\u5b66"], "532":["532", "\u6fb3\u6d32\u7559\u5b66"], "534":["534", "\u975e\u6d32\u7559\u5b66"], "535":["535", "\u5176\u4ed6"]}, "655":{"114":["114", "\u7f51\u7edc\u8fdc\u7a0b"]}};
//        var HXDialogCate2LIST = {"487":{"7":["7", "\u8f6f\u4ef6\u5f00\u53d1"], "14":["14", "\u8f6f\u4ef6\u6d4b\u8bd5"], "10":["10", "\u7f51\u7edc\u5de5\u7a0b\u5e08"], "15":["15", "\u6570\u636e\u5e93\u5de5\u7a0b\u5e08"], "437":["437", "\u7cfb\u7edf\u67b6\u6784\u5e08"], "19":["19", "\u8ba1\u7b97\u673a\u7b49\u7ea7\u8003\u8bd5"], "440":["440", "\u8f6f\u4ef6\u6c34\u5e73\u8003\u8bd5"], "161":["161", "\u624b\u673a\u5f00\u53d1"], "479":["479", "4G\u901a\u4fe1"], "165":["165", "\u5d4c\u5165\u5f0f\u5f00\u53d1"]}, "575":{"8":["8", "\u5e73\u9762\u8bbe\u8ba1\u5e08"], "12":["12", "\u7f51\u9875\u8bbe\u8ba1\u5e08"], "612":["612", "\u4ea4\u4e92\u8bbe\u8ba1\u5e08"], "613":["613", "UE\u8bbe\u8ba1\u5e08"], "614":["614", "\u4ea7\u54c1\u7ecf\u7406"], "410":["410", "\u5ba4\u5185\u8bbe\u8ba1\u5e08"], "577":["577", "\u5e7f\u544a\u8bbe\u8ba1\u5e08"], "16":["16", "\u88c5\u9970\u88c5\u6f62\u8bbe\u8ba1\u5e08"], "634":["634", "\u5efa\u7b51\u8bbe\u8ba1"], "635":["635", "\u666f\u89c2\u8bbe\u8ba1"], "636":["636", "\u89c4\u5212\u8bbe\u8ba1"], "641":["641", "UI\u8bbe\u8ba1\u5e08"]}, "488":{"17":["17", "\u52a8\u6f2b\u8bbe\u8ba1"], "13":["13", "\u5f71\u89c6\u5236\u4f5c"], "9":["9", "\u6e38\u620f\u5f00\u53d1"]}, "486":{"18":["18", "\u529e\u516c\u5e94\u7528\u8f6f\u4ef6"], "436":["436", "\u7f51\u7edc\u7ba1\u7406\u5458"], "159":["159", "\u7535\u8111\u7ef4\u62a4"], "160":["160", "\u901f\u5f55\u901f\u8bb0"]}, "483":{"26":["26", "\u96c5\u601d"], "24":["24", "\u56db\u516d\u7ea7"], "27":["27", "\u6258\u798f"], "28":["28", "\u6258\u4e1a"], "29":["29", "GRE"], "390":["390", "GMAT"], "443":["443", "SAT"], "478":["478", "SSAT"], "30":["30", "\u516c\u5171\u82f1\u8bed"], "21":["21", "\u5546\u52a1\u82f1\u8bed"], "20":["20", "\u57fa\u7840\u82f1\u8bed"], "657":["657", "Alevel"], "659":["659", "AP"], "149":["149", "\u804c\u79f0\u82f1\u8bed"], "22":["22", "\u4e13\u4e1a\u82f1\u8bed"], "467":["467", "\u5b66\u79d1\u82f1\u8bed"], "31":["31", "\u5c11\u513f\u82f1\u8bed"], "406":["406", "\u5251\u6865\u82f1\u8bed"], "150":["150", "\u65b0\u6982\u5ff5"], "153":["153", "\u51fa\u56fd\u6e38\u5b66"], "23":["23", "\u82f1\u8bed\u53e3\u8bed"], "25":["25", "\u53e3\u8bd1\u7b14\u8bd1"], "123":["123", "\u91d1\u878d\u82f1\u8bed"], "122":["122", "\u9152\u5e97\u82f1\u8bed"], "120":["120", "\u8c08\u5224\u82f1\u8bed"], "121":["121", "\u804c\u573a\u82f1\u8bed"], "124":["124", "\u6807\u51c6\u82f1\u8bed"], "126":["126", "\u51fa\u56fd\u82f1\u8bed"], "540":["540", "\u82f1\u8bed\u590f\u4ee4\u8425"], "541":["541", "\u82f1\u8bed\u51ac\u4ee4\u8425"]}, "484":{"34":["34", "\u65e5\u8bed"], "35":["35", "\u97e9\u8bed"], "32":["32", "\u6cd5\u8bed"], "33":["33", "\u5fb7\u8bed"], "151":["151", "\u4fc4\u8bed"], "92":["92", "\u610f\u5927\u5229\u8bed"], "36":["36", "\u897f\u73ed\u7259\u8bed"], "144":["144", "\u8461\u8404\u7259\u8bed"], "146":["146", "\u963f\u62c9\u4f2f\u8bed"], "432":["432", "\u571f\u8033\u5176\u8bed"], "428":["428", "\u8377\u5170\u8bed"], "460":["460", "\u4e39\u9ea6\u8bed"], "429":["429", "\u745e\u5178\u8bed"], "430":["430", "\u6ce2\u5170\u8bed"], "431":["431", "\u6ce2\u65af\u8bed"], "106":["106", "\u5e0c\u814a\u8bed"], "145":["145", "\u5370\u5ea6\u8bed"], "152":["152", "\u6cf0\u8bed"], "426":["426", "\u8d8a\u5357\u8bed"], "427":["427", "\u5370\u5c3c\u8bed"], "391":["391", "\u5176\u4ed6\u8bed\u8a00"]}, "491":{"37":["37", "\u9a7e\u9a76"], "195":["195", "\u6316\u6398\u673a"], "425":["425", "\u53c9\u8f66"], "194":["194", "\u88c5\u8f7d\u673a"], "463":["463", "\u5854\u540a"], "202":["202", "\u6d77\u5458"]}, "492":{"40":["40", "\u53a8\u5e08"], "558":["558", "\u5c0f\u5403"], "408":["408", "\u7cd5\u70b9"], "409":["409", "\u9762\u98df"], "49":["49", "\u8c03\u9152"], "197":["197", "\u8336\u827a"], "198":["198", "\u5496\u5561\u5e08"], "201":["201", "\u9152\u5e97\u7ba1\u7406"], "656":["656", "\u897f\u9910\u6599\u7406"]}, "496":{"41":["41", "\u6c7d\u8f66\u7ef4\u4fee\u3001\u4e13\u9879\u6280\u80fd"], "617":["617", "\u6c7d\u8f66\u6539\u88c5"], "348":["348", "\u6c7d\u8f66\u7f8e\u5bb9"], "181":["181", "\u5bb6\u7535\u7ef4\u4fee"], "182":["182", "\u624b\u673a\u7ef4\u4fee"], "183":["183", "\u7535\u8111\u7ef4\u4fee"], "184":["184", "\u6469\u6258\u8f66\u7ef4\u4fee"], "185":["185", "\u673a\u7535\u7ef4\u4fee"], "468":["468", "\u4fee\u9501\u5f00\u9501"], "596":["596", "\u76ae\u9769\u62a4\u7406"], "597":["597", "\u5bb6\u5177\u7ef4\u4fee"]}, "494":{"42":["42", "\u670d\u88c5"], "434":["434", "\u978b\u8bbe\u8ba1"], "417":["417", "\u8863\u6a71\u6574\u7406\u5e08"], "599":["599", "\u5e97\u94fa\u8fd0\u8425"], "600":["600", "\u670d\u88c5\u9648\u5217"], "601":["601", "\u670d\u88c5\u9500\u552e"], "598":["598", "\u670d\u9970\u642d\u914d"]}, "509":{"51":["51", "\u4eba\u4e8b\u884c\u653f"], "52":["52", "\u8d22\u52a1\u7ba1\u7406"], "46":["46", "\u91c7\u8d2d\u7ba1\u7406"], "521":["521", "\u9500\u552e\u7ba1\u7406"], "206":["206", "\u751f\u4ea7\u7ba1\u7406"], "469":["469", "\u5b89\u5168\u4e3b\u4efb"], "212":["212", "\u8d28\u91cf\u7ba1\u7406"], "48":["48", "\u7269\u6d41\u7ba1\u7406"], "56":["56", "\u4fe1\u606f\u7ba1\u7406"], "58":["58", "\u5de5\u5546\u7ba1\u7406"], "54":["54", "\u9879\u76ee\u7ba1\u7406"]}, "510":{"59":["59", "\u5e02\u573a\u8425\u9500"], "524":["524", "\u804c\u4e1a\u7d20\u517b"], "57":["57", "\u5546\u52a1\u79d8\u4e66"], "55":["55", "\u5546\u52a1\u64cd\u4f5c"], "53":["53", "\u5546\u52a1\u7b56\u5212"], "61":["61", "\u62d3\u5c55\u8bad\u7ec3"], "207":["207", "\u516c\u5f00\u8bfe"], "457":["457", "EAP"]}, "506":{"60":["60", "\u7535\u5b50\u5546\u52a1"], "555":["555", "\u7f8e\u56fd\u4eba\u529b\u8d44\u6e90\u4e13\u5bb6SPHR"], "112":["112", "\u4eba\u529b\u8d44\u6e90\u5e08"], "329":["329", "\u79d8\u4e66\u8d44\u683c\u8bc1"], "113":["113", "\u5e02\u573a\u8425\u9500\u8d44\u683c"], "328":["328", "\u804c\u4e1a\u57f9\u8bad\u5e08"], "72":["72", "\u9879\u76ee\u7ba1\u7406\u5e08"], "110":["110", "\u516c\u5173\u5458"], "327":["327", "\u5185\u5ba1\u5458"], "330":["330", "\u91c7\u8d2d\u5e08"], "64":["64", "\u5916\u5ba1\u5458"], "420":["420", "\u62db\u6807\u5e08"], "333":["333", "\u7b56\u5212\u5e08"], "331":["331", "\u4f9b\u5e94\u94fe\u7ba1\u7406\u5e08"], "332":["332", "\u804c\u4e1a\u7ecf\u7406\u4eba"], "334":["334", "\u804c\u4e1a\u6307\u5bfc\u5e08"], "326":["326", "\u7535\u5b50\u5546\u52a1\u5e08"], "343":["343", "\u7ba1\u7406\u54a8\u8be2\u5e08"], "610":["610", "\u5927\u6570\u636e\u5206\u6790\u5e08"], "380":["380", "\u8425\u9500\u7b56\u5212\u5e08"]}, "503":{"62":["62", "\u62a5\u5173\u5458"], "63":["63", "\u8ddf\u5355\u5458"], "66":["66", "\u5916\u9500\u5458"], "67":["67", "\u5355\u8bc1\u5458"], "68":["68", "\u8d27\u4ee3\u5458"], "69":["69", "\u7269\u6d41\u5e08"], "324":["324", "\u56fd\u9645\u5546\u52a1\u5e08"], "65":["65", "\u62a5\u68c0\u5458"]}, "501":{"70":["70", "\u516c\u52a1\u5458"], "147":["147", "\u53f8\u6cd5\u8003\u8bd5"], "387":["387", "\u519b\u8f6c\u5e72\u8003\u8bd5"], "323":["323", "\u4f01\u4e1a\u6cd5\u5f8b\u987e\u95ee"], "71":["71", "\u6559\u5e08\u8d44\u683c"], "445":["445", "\u5e7c\u5e08\u8d44\u683c"]}, "505":{"73":["73", "\u7f6e\u4e1a\u987e\u95ee"], "111":["111", "\u7269\u4e1a\u7ba1\u7406\u5e08"], "352":["352", "\u623f\u5730\u4ea7\u7b56\u5212\u5e08"], "353":["353", "\u623f\u5730\u4ea7\u4f30\u4ef7\u5e08"], "336":["336", "\u666f\u89c2\u8bbe\u8ba1\u5e08"], "360":["360", "\u57ce\u5e02\u89c4\u5212\u5e08"], "423":["423", "\u73af\u5883\u8bc4\u4ef7\u5e08"], "354":["354", "\u623f\u5730\u4ea7\u7ecf\u7eaa\u4eba"]}, "502":{"76":["76", "\u4e34\u5e8a\u533b\u5e08"], "397":["397", "\u4e2d\u897f\u533b\u7ed3\u5408\u533b\u5e08"], "398":["398", "\u4e2d\u533b\u533b\u5e08"], "399":["399", "\u516c\u536b\u533b\u5e08"], "400":["400", "\u53e3\u8154\u533b\u5e08"], "401":["401", "\u5916\u79d1\u533b\u5e08"], "403":["403", "\u5185\u79d1\u533b\u5e08"], "402":["402", "\u5987\u4ea7\u79d1\u533b\u5e08"], "340":["340", "\u836f\u5e08"], "341":["341", "\u62a4\u58eb"], "342":["342", "\u536b\u751f\u8d44\u683c"]}, "514":{"78":["78", "\u62c9\u4e01\u821e"], "214":["214", "\u8857\u821e"], "215":["215", "\u82ad\u857e\u821e"], "216":["216", "\u94a2\u7ba1\u821e"], "217":["217", "\u73b0\u4ee3\u821e"], "218":["218", "\u809a\u76ae\u821e"], "219":["219", "\u7235\u58eb\u821e"], "364":["364", "\u6c11\u65cf\u821e"], "459":["459", "\u53e4\u5178\u821e"], "89":["89", "\u745c\u73c8"]}, "512":{"79":["79", "\u4e66\u6cd5"], "552":["552", "\u88c5\u88f1"], "82":["82", "\u7ed8\u753b"]}, "513":{"83":["83", "\u94a2\u7434"], "224":["224", "\u5409\u4ed6"], "85":["85", "\u58f0\u4e50"], "81":["81", "\u5668\u4e50"], "50":["50", "DJ\u97f3\u63a7"], "446":["446", "\u53e4\u7b5d"], "447":["447", "\u53e4\u7434"], "448":["448", "\u4e8c\u80e1"], "449":["449", "\u7b1b\u7bab"], "450":["450", "\u846b\u82a6\u4e1d"], "451":["451", "\u7435\u7436"]}, "515":{"84":["84", "\u56f4\u68cb"], "220":["220", "\u8c61\u68cb"]}, "516":{"88":["88", "\u8db3\u7403"], "87":["87", "\u7bee\u7403"], "80":["80", "\u6392\u7403"], "225":["225", "\u7fbd\u6bdb\u7403"], "226":["226", "\u5175\u4e53\u7403"], "227":["227", "\u7f51\u7403"], "228":["228", "\u53f0\u7403"], "549":["549", "\u68d2\u7403"], "652":["652", "\u9ad8\u5c14\u592b"], "651":["651", "\u5176\u4ed6"]}, "529":{"94":["94", "\u8003\u7814"], "255":["255", "\u8003\u535a"], "253":["253", "\u7a7a\u4e58\u4e13\u4e1a"], "99":["99", "MBA"], "366":["366", "EMBA"], "256":["256", "MPA"], "257":["257", "MPM"], "97":["97", "\u5728\u804c\u7855\u58eb"], "442":["442", "\u5728\u804c\u535a\u58eb"], "258":["258", "\u6cd5\u5f8b\u7855\u58eb"], "259":["259", "\u4f1a\u8ba1\u7855\u58eb"], "260":["260", "\u6559\u80b2\u7855\u58eb"], "261":["261", "\u5de5\u7a0b\u7855\u58eb"], "98":["98", "\u7814\u4fee\u73ed"]}, "528":{"96":["96", "\u81ea\u8003"], "95":["95", "\u6210\u4eba\u9ad8\u8003"], "415":["415", "\u5bf9\u53e3\u5347\u5b66"], "102":["102", "\u4e2d\u5916\u672c\u79d1"], "254":["254", "\u4e13\u8f6c\u672c"], "251":["251", "\u540c\u7b49\u5b66\u5386"], "262":["262", "\u8fdc\u7a0b\u5b66\u5386"], "461":["461", "\u5f00\u653e\u6559\u80b2"], "307":["307", "\u5176\u4ed6\u5b66\u5386"]}, "499":{"103":["103", "\u4f1a\u8ba1\u4ece\u4e1a\u8d44\u683c"], "547":["547", "\u5b9e\u64cd"], "551":["551", "\u5b9e\u64cd\u4f1a\u8ba1\u5e08"], "310":["310", "\u521d\u7ea7\u4f1a\u8ba1\u804c\u79f0"], "311":["311", "\u4e2d\u7ea7\u4f1a\u8ba1\u804c\u79f0"], "312":["312", "\u9ad8\u7ea7\u4f1a\u8ba1\u804c\u79f0"], "141":["141", "\u6ce8\u518c\u4f1a\u8ba1\u5e08"], "553":["553", "\u7f8e\u56fd\u6ce8\u518c\u4f1a\u8ba1\u5e08"], "554":["554", "\u7f8e\u56fd\u6ce8\u518c\u7ba1\u7406\u4f1a\u8ba1\u5e08"], "477":["477", "AIA\u56fd\u9645\u4f1a\u8ba1\u5e08"], "473":["473", "ACCA"], "456":["456", "\u4f1a\u8ba1\u7ee7\u7eed\u6559\u80b2"]}, "504":{"108":["108", "\u5efa\u9020\u5e08"], "615":["615", "\u6d88\u9632\u5de5\u7a0b\u5e08"], "351":["351", "\u5efa\u7b51\u5e08"], "355":["355", "\u76d1\u7406\u5de5\u7a0b\u5e08"], "454":["454", "\u8d44\u6599\u5458"], "357":["357", "\u54a8\u8be2\u5de5\u7a0b\u5e08"], "414":["414", "\u9020\u4ef7\u5458"], "361":["361", "\u9020\u4ef7\u5de5\u7a0b\u5e08"], "196":["196", "\u5efa\u7b51\u4e5d\u5927\u5458"], "362":["362", "\u7ed3\u6784\u5de5\u7a0b\u5e08"], "356":["356", "\u5b89\u5168\u5de5\u7a0b\u5e08"], "358":["358", "\u8d28\u91cf\u5de5\u7a0b\u5e08"], "359":["359", "\u5ba4\u5185\u8bbe\u8ba1\u5e08"], "422":["422", "\u6ce8\u518c\u6d4b\u7ed8\u5e08"], "424":["424", "\u6ce8\u518c\u8ba1\u91cf\u5e08"], "481":["481", "\u5ca9\u571f\u5de5\u7a0b\u5e08"]}, "507":{"109":["109", "\u5fc3\u7406\u54a8\u8be2\u5e08"], "75":["75", "\u516c\u5171\u8425\u517b\u5e08"], "349":["349", "\u5065\u5eb7\u7ba1\u7406\u5e08"], "345":["345", "\u50ac\u7720\u5e08"], "74":["74", "\u80b2\u5a74\u5e08"], "107":["107", "\u793e\u4f1a\u5de5\u4f5c\u8005"], "472":["472", "\u62db\u8c03\u5de5"], "350":["350", "\u5a5a\u793c\u987e\u95ee"], "376":["376", "\u5a5a\u5e86\u7b56\u5212\u5e08"], "378":["378", "\u4f1a\u5c55\u7b56\u5212\u5e08"], "379":["379", "\u5e7f\u544a\u5a92\u4f53\u7b56\u5212\u5e08"], "44":["44", "\u5bfc\u6e38\u8d44\u683c\u8bc1"], "346":["346", "\u65c5\u6e38\u54a8\u8be2\u5e08"], "377":["377", "\u65c5\u6e38\u7b56\u5212\u5e08"], "337":["337", "\u6c7d\u8f66\u8425\u9500\u5e08"], "339":["339", "\u6c7d\u8f66\u8bc4\u4f30\u5e08"], "118":["118", "\u65c5\u6e38\u7ecf\u7eaa\u4eba"], "338":["338", "\u6c7d\u8f66\u7ecf\u7eaa\u4eba"], "602":["602", "\u5f55\u97f3\u5e08"], "381":["381", "\u51fa\u7248\u4e13\u4e1a\u8d44\u683c"], "603":["603", "\u97f3\u54cd\u5e08"], "363":["363", "\u5176\u4ed6\u8d44\u683c\u8ba4\u8bc1"], "604":["604", "\u706f\u5149\u5e08"], "453":["453", "\u745c\u4f3d\u6559\u7ec3"], "476":["476", "\u7279\u79cd\u4f5c\u4e1a\u64cd\u4f5c\u8bc1"], "573":["573", "\u773c\u955c\u9a8c\u5149\u5458"], "574":["574", "\u773c\u955c\u5b9a\u914d\u5de5"]}, "530":{"132":["132", "\u7f8e\u56fd\u7559\u5b66"], "133":["133", "\u52a0\u62ff\u5927\u7559\u5b66"], "282":["282", "\u5df4\u897f\u7559\u5b66"], "283":["283", "\u963f\u6839\u5ef7\u7559\u5b66"], "370":["370", "\u58a8\u897f\u54e5\u7559\u5b66"]}, "531":{"134":["134", "\u82f1\u56fd\u7559\u5b66"], "130":["130", "\u5fb7\u56fd\u7559\u5b66"], "131":["131", "\u6cd5\u56fd\u7559\u5b66"], "263":["263", "\u610f\u5927\u5229\u7559\u5b66"], "264":["264", "\u4fc4\u7f57\u65af\u7559\u5b66"], "128":["128", "\u8377\u5170\u7559\u5b66"], "265":["265", "\u897f\u73ed\u7259\u7559\u5b66"], "267":["267", "\u745e\u58eb\u7559\u5b66"], "266":["266", "\u8461\u8404\u7259\u7559\u5b66"], "268":["268", "\u745e\u5178\u7559\u5b66"], "269":["269", "\u6bd4\u5229\u65f6\u7559\u5b66"], "129":["129", "\u7231\u5c14\u5170\u7559\u5b66"], "270":["270", "\u4e39\u9ea6\u7559\u5b66"], "271":["271", "\u82ac\u5170\u7559\u5b66"], "367":["367", "\u5362\u68ee\u5821\u7559\u5b66"], "272":["272", "\u5965\u5730\u5229\u7559\u5b66"], "273":["273", "\u5308\u7259\u5229\u7559\u5b66"], "274":["274", "\u632a\u5a01\u7559\u5b66"], "275":["275", "\u6ce2\u5170\u7559\u5b66"], "284":["284", "\u5e0c\u814a\u7559\u5b66"], "285":["285", "\u6377\u514b\u7559\u5b66"], "369":["369", "\u7acb\u9676\u5b9b\u7559\u5b66"], "138":["138", "\u9a6c\u8033\u4ed6\u7559\u5b66"]}, "532":{"136":["136", "\u6fb3\u6d32\u7559\u5b66"], "135":["135", "\u65b0\u897f\u5170\u7559\u5b66"]}, "533":{"140":["140", "\u65e5\u672c\u7559\u5b66"], "127":["127", "\u97e9\u56fd\u7559\u5b66"], "137":["137", "\u65b0\u52a0\u5761\u7559\u5b66"], "139":["139", "\u9a6c\u6765\u897f\u4e9a\u7559\u5b66"], "276":["276", "\u83f2\u5f8b\u5bbe\u7559\u5b66"], "277":["277", "\u6cf0\u56fd\u7559\u5b66"], "278":["278", "\u5370\u5ea6\u7559\u5b66"], "279":["279", "\u5370\u5c3c\u7559\u5b66"], "280":["280", "\u8d8a\u5357\u7559\u5b66"], "281":["281", "\u67ec\u57d4\u5be8\u7559\u5b66"]}, "493":{"142":["142", "\u5316\u5986"], "628":["628", "\u5f62\u8c61\u987e\u95ee"], "630":["630", "\u534a\u6c38\u4e45\u5316\u5986"], "38":["38", "\u7f8e\u5bb9"], "39":["39", "\u7f8e\u53d1"], "143":["143", "\u7f8e\u7532"], "175":["175", "\u8272\u5f69"], "543":["543", "\u7eb9\u7ee3"], "43":["43", "\u793c\u4eea"], "176":["176", "\u5f62\u8c61\u8bbe\u8ba1"], "177":["177", "\u6444\u5f71"], "383":["383", "\u5f69\u5986\u9020\u578b"], "537":["537", "\u6574\u5f62\u7f8e\u5bb9"], "536":["536", "\u5ba0\u7269\u7f8e\u5bb9"]}, "576":{"158":["158", "AutoCAD"], "620":["620", "ug"], "619":["619", "creo"], "618":["618", "pro\/e"], "621":["621", "catia"], "444":["444", "3D MAX"], "589":["589", "Photoshop"], "578":["578", "Maya"], "579":["579", "Flash"], "580":["580", "Dreamweaver"], "581":["581", "Frontpage"], "582":["582", "Coreldraw"], "584":["584", "Fireworks"], "583":["583", "Cinema4D"], "585":["585", "Zbrush"], "586":["586", "Poser"], "587":["587", "Silo"], "588":["588", "Modo"], "605":["605", "ILLUSTRATOR"], "606":["606", "Freehand"], "607":["607", "DIV+CSS"], "650":["650", "\u5176\u4ed6"]}, "495":{"178":["178", "\u6a21\u7279"], "222":["222", "\u64ad\u97f3\u5458"], "223":["223", "\u4e3b\u6301\u4eba"], "179":["179", "\u6f14\u827a"], "654":["654", "\u9752\u5c11\u513f\u64ad\u97f3\u4e3b\u6301"]}, "497":{"186":["186", "\u7535\u5de5"], "189":["189", "\u710a\u5de5"], "191":["191", "\u94b3\u5de5"], "187":["187", "\u8f66\u5de5"], "190":["190", "\u94e3\u5de5"], "188":["188", "\u6570\u63a7\u673a\u5e8a"], "192":["192", "\u6a21\u5177\u8bbe\u8ba1"], "608":["608", "PLC\u7f16\u7a0b"], "595":["595", "\u53f8\u7089\u5de5"], "642":["642", "\u5de5\u4e1a\u673a\u5668\u4eba"]}, "508":{"208":["208", "\u6218\u7565\u7ba1\u7406"], "211":["211", "\u5371\u673a\u7ba1\u7406"], "209":["209", "\u9886\u5bfc\u827a\u672f"], "210":["210", "\u603b\u88c1\u7814\u4fee\u73ed"], "482":["482", "\u56fd\u5b66\u667a\u6167"]}, "511":{"213":["213", "\u5176\u4ed6\u4f01\u4e1a\u7ba1\u7406"], "455":["455", "\u9910\u996e\u7ba1\u7406"], "559":["559", "\u623f\u5730\u4ea7\u7ba1\u7406"]}, "520":{"238":["238", "\u9ad8\u8003\u590d\u8bfb"], "412":["412", "\u5f71\u89c6\u8868\u6f14\u827a\u8003\u8f85\u5bfc"], "413":["413", "\u5f71\u89c6\u7f16\u5bfc\u827a\u8003\u8f85\u5bfc"], "241":["241", "\u4f53\u80b2\u7279\u62db"], "475":["475", "\u827a\u8003\u6587\u5316\u8bfe"], "249":["249", "\u9ad8\u8003\u8f85\u5bfc\u73ed"], "411":["411", "\u64ad\u97f3\u4e3b\u6301\u827a\u8003\u8f85\u5bfc"], "100":["100", "\u9ad8\u8003\u7f8e\u672f\u7c7b\u8f85\u5bfc"], "240":["240", "\u9ad8\u8003\u97f3\u4e50\u7c7b\u8f85\u5bfc"], "250":["250", "\u9ad8\u8003\u5f71\u89c6\u7c7b\u8f85\u5bfc"], "384":["384", "\u9ad8\u8003\u821e\u8e48\u7c7b\u8f85\u5bfc"]}, "523":{"244":["244", "\u8bb0\u5fc6\u529b"], "632":["632", "\u8111\u529b\u57f9\u8bad"], "371":["371", "\u65e9\u6559\u4e2d\u5fc3"], "392":["392", "\u5e7c\u513f\u56ed"], "464":["464", "\u5168\u8111\u6f5c\u80fd\u5f00\u53d1"], "243":["243", "\u5e7c\u513f\u667a\u529b\u5f00\u53d1"], "365":["365", "\u8bb2\u6545\u4e8b"], "560":["560", "\u62fc\u97f3\u8bc6\u5b57"], "245":["245", "\u73e0\u7b97\u5fc3\u7b97"], "561":["561", "\u5e7c\u5c0f\u8854\u63a5"], "474":["474", "\u5c11\u513f\u827a\u672f\u542f\u8499"]}, "525":{"246":["246", "\u7d20\u8d28\u8bad\u7ec3"], "247":["247", "\u590f\u4ee4\u8425"], "248":["248", "\u51ac\u4ee4\u8425"]}, "114":{"287":["287", "\u7f51\u6821\u5b66\u4e60\u5361"], "115":["115", "\u8fdc\u7a0b\u9ad8\u8d77\u4e13"], "117":["117", "\u8fdc\u7a0b\u9ad8\u8d77\u672c"], "116":["116", "\u8fdc\u7a0b\u4e13\u5347\u672c"], "290":["290", "\u8fdc\u7a0b\u81ea\u8003"], "293":["293", "\u8fdc\u7a0b\u8003\u7814"], "300":["300", "\u8fdc\u7a0b\u6210\u4eba\u9ad8\u8003"], "301":["301", "\u8fdc\u7a0b\u4e2d\u5c0f\u5b66"], "303":["303", "\u8fdc\u7a0b\u6587\u4f53\u827a\u672f"], "302":["302", "\u8fdc\u7a0b\u5728\u804c\u7855\u58eb"], "289":["289", "\u8fdc\u7a0b\u5916\u8bed"], "304":["304", "\u8fdc\u7a0b\u7535\u8111"], "288":["288", "\u8fdc\u7a0b\u8d22\u4f1a"], "291":["291", "\u8fdc\u7a0b\u516c\u52a1\u5458"], "298":["298", "\u8fdc\u7a0b\u6cd5\u5f8b"], "295":["295", "\u8fdc\u7a0b\u91d1\u878d"], "305":["305", "\u8fdc\u7a0b\u5916\u8d38"], "296":["296", "\u8fdc\u7a0b\u5efa\u7b51"], "297":["297", "\u8fdc\u7a0b\u533b\u536b"], "292":["292", "\u8fdc\u7a0b\u4eba\u529b\u8d44\u6e90"], "299":["299", "\u8fdc\u7a0b\u5fc3\u7406\u54a8\u8be2"], "306":["306", "\u5176\u4ed6\u8fdc\u7a0b"]}, "534":{"368":["368", "\u5357\u975e\u7559\u5b66"]}, "535":{"385":["385", "\u51fa\u56fd\u52b3\u52a1"], "386":["386", "\u52a0\u62ff\u5927\u4f4f\u5bb6\u4fdd\u59c6"], "286":["286", "\u5176\u4ed6\u51fa\u56fd\u7559\u5b66"], "629":["629", "\u827a\u672f\u7c7b\u7559\u5b66"]}, "526":{"393":["393", "\u5c0f\u5b66"], "660":["660", "\u673a\u5668\u4eba\u57f9\u8bad"], "394":["394", "\u4e2d\u5b66"], "308":["308", "\u5176\u4ed6\u4e2d\u5c0f\u5b66"], "565":["565", "\u56fd\u5b66"], "566":["566", "\u7236\u6bcd\u4eb2\u5b50\u6559\u80b2"]}, "490":{"418":["418", "iphone\u5f00\u53d1"], "419":["419", "android\u5f00\u53d1"], "166":["166", "\u5317\u5927\u9752\u9e1fACCP"], "441":["441", "\u5317\u5927\u9752\u9e1fBENET"], "169":["169", "\u601d\u79d1\u8ba4\u8bc1"], "167":["167", "\u5fae\u8f6f\u8ba4\u8bc1"], "170":["170", "\u534e\u4e3a\u8ba4\u8bc1"], "439":["439", "H3C\u8ba4\u8bc1"], "404":["404", "PHP"], "174":["174", "JAVA"], "168":["168", "NIIT\u8ba4\u8bc1"], "171":["171", "IBM\u8ba4\u8bc1"], "172":["172", "Linux\u8ba4\u8bc1"], "164":["164", "Oracle\u8ba4\u8bc1"], "173":["173", "SUN\u8ba4\u8bc1"], "162":["162", "Adobe\u8ba4\u8bc1"], "163":["163", "Macromedia"], "405":["405", "SAP\u8ba4\u8bc1"], "372":["372", "Symbian\u8ba4\u8bc1"], "373":["373", "ARM\u8ba4\u8bc1"], "374":["374", "wince\u8ba4\u8bc1"], "375":["375", "VxWorks\u8ba4\u8bc1"], "204":["204", "\u5176\u4ed6\u8ba1\u7b97\u673a"], "563":["563", "VMware\u865a\u62df\u5316"]}, "489":{"435":["435", "\u7535\u5b50\u5546\u52a1\u5e08"], "407":["407", "\u7f51\u7edc\u8425\u9500"], "471":["471", "\u6dd8\u5b9d\u5f00\u5e97"]}, "519":{"452":["452", "\u4e00\u5bf9\u4e00\u8f85\u5bfc"], "631":["631", "\u8111\u529b\u57f9\u8bad"], "157":["157", "\u5c0f\u5b66\u8f85\u5bfc\u73ed"], "242":["242", "\u79d1\u6280\u7ade\u8d5b\u8f85\u5bfc"], "562":["562", "\u8bed\u6570\u5916\u7ade\u8d5b\u8f85\u5bfc"], "234":["234", "\u521d\u4e2d\u8f85\u5bfc\u73ed"], "235":["235", "\u9ad8\u4e2d\u8f85\u5bfc\u73ed"], "236":["236", "\u5bb6\u6559\u8f85\u5bfc"], "237":["237", "\u4f5c\u6587\u8f85\u5bfc"]}, "527":{"462":["462", "\u4e2d\u4e13"], "101":["101", "\u666e\u901a\u9662\u6821"], "395":["395", "\u91cd\u70b9\u5927\u5b66"], "396":["396", "\u9ad8\u804c\u9662\u6821"], "252":["252", "\u6c11\u529e\u9662\u6821"]}, "498":{"539":["539", "\u9488\u5200\u6574\u9aa8"], "538":["538", "\u9488\u7078"], "45":["45", "\u4fdd\u5065\u6309\u6469"], "180":["180", "\u8db3\u7597\u5e08"], "544":["544", "\u6708\u5ac2"], "548":["548", "\u50ac\u4e73\u5e08"], "611":["611", "\u98ce\u6c34\u5e08"], "199":["199", "\u63d2\u82b1\u82b1\u827a"], "200":["200", "POP\u624b\u7ed8"], "653":["653", "\u522e\u75e7"], "388":["388", "\u521b\u4e1a\u6307\u5bfc"], "389":["389", "\u5c31\u4e1a\u6307\u5bfc"], "203":["203", "\u5176\u4ed6\u804c\u4e1a"]}, "517":{"542":["542", "\u51fb\u5251"], "86":["86", "\u9493\u9c7c"], "518":["518", "\u9b54\u672f"], "229":["229", "\u8f6e\u6ed1"], "231":["231", "\u6e38\u6cf3"], "230":["230", "\u5065\u8eab"], "91":["91", "\u7ade\u6280"], "232":["232", "\u6b66\u672f"], "564":["564", "\u640f\u51fb"], "90":["90", "\u8dc6\u62f3\u9053"], "233":["233", "\u592a\u6781\u62f3"], "221":["221", "\u5f71\u89c6\u620f\u5267"], "309":["309", "\u5176\u4ed6"], "623":["623", "\u51cf\u80a5"]}, "485":{"545":["545", "\u53e3\u5403\u77eb\u6b63"], "155":["155", "\u666e\u901a\u8bdd"], "433":["433", "\u7ca4\u8bed"], "156":["156", "\u6f14\u8bb2\u53e3\u624d"], "609":["609", "\u8499\u8bed"], "154":["154", "\u5bf9\u5916\u6c49\u8bed"]}, "567":{"568":["568", "\u827a\u672f\u54c1\u9274\u5b9a\u5e08"], "569":["569", "\u827a\u672f\u54c1\u8bc4\u4f30\u5e08"], "570":["570", "\u827a\u672f\u54c1\u7ecf\u7eaa\u4eba"], "571":["571", "\u7fe0\u7389\u9274\u5b9a\u5e08"], "572":["572", "\u56fd\u9645\u6ce8\u518c\u827a\u672f\u54c1\u9274\u5b9a\u5e08"]}, "590":{"591":["591", "\u56fd\u9645\u5e7c\u513f\u56ed"], "592":["592", "\u56fd\u9645\u5c0f\u5b66"], "593":["593", "\u56fd\u9645\u521d\u4e2d"], "556":["556", "\u56fd\u9645\u9ad8\u4e2d"], "557":["557", "\u56fd\u5185\u9884\u79d1"], "594":["594", "\u56fd\u5916\u9884\u79d1"]}, "500":{"626":["626", "\u80a1\u6307\u57f9\u8bad"], "624":["624", "\u80a1\u7968\u57f9\u8bad"], "625":["625", "\u5916\u6c47\u57f9\u8bad"], "622":["622", "\u7f51\u7edc\u91d1\u878d"], "546":["546", "\u8d35\u91d1\u5c5e\u4ea4\u6613\u5e08"], "313":["313", "\u6ce8\u518c\u7a0e\u52a1\u5e08"], "318":["318", "\u8d44\u4ea7\u8bc4\u4f30\u5e08"], "314":["314", "\u7ecf\u6d4e\u5e08"], "315":["315", "\u7edf\u8ba1\u5e08"], "316":["316", "\u5ba1\u8ba1\u5e08"], "416":["416", "\u56fd\u9645\u5185\u5ba1\u5e08"], "658":["658", "\u4fe1\u7528\u7ba1\u7406\u5e08"], "317":["317", "\u7cbe\u7b97\u5e08"], "382":["382", "\u7edf\u8ba1\u4ece\u4e1a\u8d44\u683c"], "319":["319", "\u94f6\u884c\u4ece\u4e1a\u8d44\u683c"], "322":["322", "\u671f\u8d27\u4ece\u4e1a\u8d44\u683c"], "344":["344", "\u4fdd\u9669\u4ece\u4e1a\u8d44\u683c"], "421":["421", "\u57fa\u91d1\u4ece\u4e1a\u8d44\u683c"], "320":["320", "\u8bc1\u5238\u4ece\u4e1a\u8d44\u683c"], "321":["321", "\u8bc1\u5238\u7ecf\u7eaa\u4eba"], "347":["347", "\u91d1\u878d\u5206\u6790\u5e08"], "465":["465", "\u91d1\u878d\u89c4\u5212\u5e08"], "466":["466", "\u9ec4\u91d1\u5206\u6790\u5e08"], "77":["77", "\u7406\u8d22\u89c4\u5212\u5e08"], "325":["325", "\u4ef7\u683c\u9274\u8bc1\u5e08"], "470":["470", "\u4ef7\u683c\u9274\u8bc1\u5e08"]}};
//CSS
var HXDialogCateCSS = '<style type="text/css">' +
        '#HXDialogCate{z-index:9999;background:#FFFFFF;}' +
        '.HXDialogCateC{width:657px;position: relative;}' +
        '.HXDialogCateH{height:20px;overflow:hidden;position: relative;margin-top:-20px;}' +
        '.HXDialogCateHC{background:#D5E0F9;width:60px;float:right;line-height:20px;text-align:center;}' +
        '.HXDialogCateHC span{font-size:12px;color:#3366FF !important;font-size:12px;font-weight:normal;text-decoration:none;padding-left:5px;cursor:pointer;}' +
        '.HXDialogCateHC span:hover{color:red !important;}' +
        '.HXDialogCateB{float:left;overflow:hidden;border:1px solid #CCCCCC;}' +
        '.HXDialogCateBL{float: left;width:50px;}' +
        '.HXDialogCateBL ul{list-style:none;margin:0;padding:0;}' +
        '.HXDialogCateBL ul li{border-bottom:1px solid #cccccc;border-right:1px solid #cccccc;background:#999999;overflow:hidden;line-height:30px;text-align:center;}' +
        '.HXDialogCateBL ul li a:link{display:inline-block; font-weight:bold;font-size:12px;font-weight:normal;text-decoration:none;line-height:16px;color:#ffffff;}' +
        '.HXDialogCateBL ul li a:visited{display:inline-block; font-weight:bold;font-size:12px;font-weight:normal;text-decoration:none;line-height:16px;color:#ffffff;}' +
        '.HXDialogCateBM{float:left;width:80px;border-right:1px solid #CCCCCC;}' +
        '.HXDialogCateBM ul{list-style:none;margin:0;padding:0;}' +
        '.HXDialogCateBM ul li{border-bottom:1px solid #e1e1e1;width:80px;height:30px;overflow:hidden;line-height:30px;text-align:center;position:relative; overflow:visible;}' +
        '.HXDialogCateBM ul li a{background:none repeat scroll 0 0 #f5f5f5;width:80px;height:30px;display:block;color:#666666;font-size:12px;font-weight:normal;text-decoration:none;}' +
        '.HXDialogCateBM ul li .category_on,.category_select_sidebarL ul li a:hover{background:none repeat scroll 0 0 #ffffff;color:#ff4136}' +
        '.HXDialogCateBR{float:left;width:513px;margin-left:10px;height:450px;overflow:auto;}' +
        '.HXDialogCateBR_line{float:left;width:100%;border-bottom:1px dashed #dbdbdb;padding: 5px 0;}' +
        '.HXDialogCateBR_lineL{float:left;width:80px;margin-top:6px;}' +
        '.HXDialogCateBR_lineL span{color:#0066ff;height:20px;line-height:20px;font-size:12px;font-weight:normal;text-decoration:none;cursor: pointer;}' +
        '.HXDialogCateBR_lineL span:hover{color:red !important;font-weight:bold;}' +
        '.HXDialogCateBR_lineR{float:left;width:400px;}' +
        '.HXDialogCateBR_lineR ul{list-style:none;margin:0;padding:0;}' +
        '.HXDialogCateBR_lineR ul li{float:left;width:76px;height:20px;line-height:20px;text-align:left;}' +
        '.HXDialogCateBR_lineR ul li a{color:#5f5f5f !important;font-size:12px;font-weight:normal;text-decoration:none;}' +
        '.HXDialogCateBR_lineR ul li a:hover{color:red !important;font-weight:bold;}' +
        '#HXDialogCateFastSearchInputUl input{border-color:#BFBBB5;border-style:solid;border:1px solid #cccccc;width:300px;padding:6px;color:#999999;font-size:14px;height:20px;line-height:20px;margin-bottom:5px;}' +
        '</style>';
//模板
var HXDialogCateTPL = '<div class="HXDialogCateC">' +
        '<div class="HXDialogCateH">' +
        '<div class="HXDialogCateHC" id="HXDialogCateClose"></div>' +
        '</div>' +
        '<div class="HXDialogCateB">' +
        '<div class="HXDialogCateBL"><ul>' +
        '<li style="height:30px;"><a href="javascript:;" style="margin-top:5px;" id="HXDialogCateAllCate">全行业</a></li>' +
        '<li style="height:92px;"><a href="javascript:;" style="margin-top:30px;">0- 18岁<br />培训</a></li>' +
        '<li style="height:123px;"><a href="javascript:;" style="margin-top:45px;">成人<br />培训</a></li>' +
        '<li style="height:92px;"><a href="javascript:;" style="margin-top:30px;">学历<br />文凭</a></li>' +
        '</ul></div>' +
        '<div class="HXDialogCateBM"><ul id="HXDialogCateBMUl"></ul></div>' +
        '<div class="HXDialogCateBR" id="HXDialogCateBR"></div>' +
        '</div>' +
        '</div>';
var HXDialogCate = function (options) {
    this.init(options);
};
HXDialogCate.prototype = {
    $: function (id) {
        return document.getElementById(id);
    },
    _addEvent: function (el, evname, func) {
        if (el.attachEvent) { // IE
            el.attachEvent("on" + evname, func);
        } else if (el.addEventListener) { // Gecko / W3C
            el.addEventListener(evname, func, true);
        } else {
            el["on" + evname] = func;
        }
    },
    _removeEvent: function (el, evname, func) {
        if (el.detachEvent) { // IE
            el.detachEvent("on" + evname, func);
        } else if (el.removeEventListener) { // Gecko / W3C
            el.removeEventListener(evname, func, true);
        } else {
            el["on" + evname] = null;
        }
    },
    _createElement: function (type, parent) {
        var el = null;
        if (document.createElementNS) {
            el = document.createElementNS("http://www.w3.org/1999/xhtml", type);
        } else {
            el = document.createElement(type);
        }
        if (typeof parent != "undefined") {
            parent.appendChild(el);
        }
        return el;
    },
    _param_default: function (options, pname, def) {
        if (typeof this.options[pname] == "undefined")
            this.options[pname] = def;
        return this;
    },
    init: function (options) {
        this.options = options;
        this._param_default(this.options, 'divId', 'HXDialogCate');
        this._param_default(this.options, 'inputField', null);
        this._param_default(this.options, 'displayField', null);
        this._param_default(this.options, 'displayPosition', 'Right Bottom');
        this._param_default(this.options, 'retLevel', null);
        this.OBJIF = this.$(this.options.inputField);
        this.OBJDF = this.$(this.options.displayField);
        var _this = this;
        this._addEvent(this.OBJDF, "click", function (e) {
            _this.open();
        });
        HXDialogCateCount++;
        this._addEvent(document.body, "click", function (e) {
            var obj = e.srcElement ? e.srcElement : e.target;
            var flag = false;
            while (obj.tagName.toUpperCase() != 'BODY') {
                if ('HXDialogCate' == obj.id || _this.options.displayField == obj.id) {
                    flag = true;
                    break;
                }
                obj = obj.parentNode;
            }
            if (!flag)
                _this.close();
        });
        this._addEvent(document.body, "keydown", function (e) {
            _this.onKeydown(e)
        });
        return this;
    },
    onKeydown: function (e) {
        if (27 == e.keyCode)
            this.close();
    },
    open: function () {
        if (this.$('HXDialogArea'))
            this.$('HXDialogArea').style.display = 'none';
        this.Div = this.$(this.options.divId);
        if (!this.Div) {
            this.Div = this._createElement('div', document.body);
            this.Div.id = this.options.divId;
            this.Div.style.position = 'absolute';
            this.Div.innerHTML = HXDialogCateTPL;
        }
        var obj = this.OBJDF, t = obj.offsetTop, l = obj.offsetLeft;
        while (obj = obj.offsetParent) {//判断是否有父容器，如果存在则累加其边距
            t += obj.offsetTop; //叠加父容器的上边距
            l += obj.offsetLeft; //叠加父容器的左边距
        }
        if (this.options.displayPosition == 'auto') {
            this.Div.style.left = l + 'px';
            this.Div.style.top = $(window).height() / 2 - 300 + 'px';
        }
        else {
            var Px = this.options.displayPosition.split(' ')[0];
            this.Div.style.left = Px == "Center" ? (l - 656 / 2) + 'px' : (Px == "Left" ? (l - 656) + 'px' : l + 'px');
            var Py = this.options.displayPosition.split(' ')[1];
            this.Div.style.top = Py == "Center" ? (t + this.OBJDF.offsetHeight - 360 / 2) + 'px' : (Py == "Left" ? (t + this.OBJDF.offsetHeight - 360) + 'px' : (t + this.OBJDF.offsetHeight) + 'px');
        }
        this.Div.style.display = 'block';
        this.CLOSE = this.$('HXDialogCateClose');
        this.BMUl = this.$('HXDialogCateBMUl');
        this.BR = this.$('HXDialogCateBR');
        var _this = this;
        //全行业
        this._addEvent(this.$('HXDialogCateAllCate'), "click", function () {
            _this.finalSel(0, 0, 0);
        });
        //清除、关闭
        this.CLOSE.innerHTML = '';
        var el = this._createElement('span', this.CLOSE);
        el.innerHTML = '清除';
        this._addEvent(el, "click", function () {
            _this.clear();
        });
        var el = this._createElement('span', this.CLOSE);
        el.innerHTML = '关闭';
        this._addEvent(el, "click", function () {
            _this.close();
        });
        this.BMUl.innerHTML = '';
        //B-JUI框架作者在新版中，改变了array,此处将数组循环改为jQuery的each()方法遍历
        //for(var k in HXDialogCateLList){
        for (var k = 0; k < HXDialogCateLList.length; ++k) {
            var d = HXDialogCateLList[k];
            var el = this._createElement('li', this.BMUl);
            el.innerHTML = '<span style="position:absolute;top:10px;right:-6px;"><img src="/resources/style/index/images/type_right_jt.jpg"></span><a href="javascript:;" title="' + d[1] + '">' + d[1] + '</a>';
            (function (k) {
                _this._addEvent(el, "mouseover", function () {
                    _this.mouseover(k);
                });
            })(k);
        }
        this.mouseover(0, 0);
        return this;
    },
    close: function () {
        if (this.Div != undefined)
            this.Div.style.display = 'none';
        return this;
    },
    clear: function () {
        if (this.OBJDF.type)
            this.OBJDF.value = '';
        else
            this.OBJDF.innerHTML = '';
        this.OBJIF.value = "";
        this.OBJIF.value = "";
        this.close();
        return this;
    },
    mouseover: function (k) {
        var lis = this.BMUl.getElementsByTagName('li');
        for (i = 0; i < lis.length; i++)
        {
            lis[i].getElementsByTagName('span')[0].style.display = (k == i) ? '' : 'none';
            lis[i].getElementsByTagName('a')[0].className = (k == i) ? 'category_on' : '';
        }
        this.showsubcate(HXDialogCateLList[k][0]);
    },
    showsubcate: function (id) {
        var _this = this;
        this.BR.innerHTML = '';
        var theCatgory0 = HXDialogCate0LIST[id];
        var el = this._createElement('div', this.BR);
        el.className = 'HXDialogCateBR_line';
        '<div class="HXDialogCateBR_lineR " ><ul id="HXDialogCateFastSearchInputUl"></ul><ul id="HXDialogCateFastSearchResult"></ul></div></div>';
        '<div class="HXDialogCateBR_lineR"><ul id="HXDialogCateLastLogUl"></ul></div>';
        if (id == "114")
        {	//一行
            var el = this._createElement('div', this.BR);
            el.className = 'HXDialogCateBR_line';
            el.innerHTML = '<div class="HXDialogCateBR_lineL" id="HXDialogCateBR_lineL_' + theCatgory0[0] + '"></div>' +
                    '<div class="HXDialogCateBR_lineR"><ul id="HXDialogCateBR_lineRUl_' + theCatgory0[0] + '"></ul></div>';
            //一行左边
            var el = this._createElement('span', this.$('HXDialogCateBR_lineL_' + theCatgory0[0]));
            el.title = el.innerHTML = theCatgory0[1];
            this._addEvent(el, "click", function () {
                _this.finalSel(theCatgory0[0]);
            });
            //一行右边
            for (var k in HXDialogCate1LIST[id])
            {
                var theCatgory1 = HXDialogCate1LIST[id][k];
                var el = this._createElement('li', this.$('HXDialogCateBR_lineRUl_' + theCatgory0[0]));
                el.innerHTML = '<a title="' + theCatgory1[1] + '" href="javascript:;">' + theCatgory1[1].substr(0, 4) + '</a>';
                (function (k) {
                    _this._addEvent(el, "click", function () {
                        _this.finalSel(theCatgory0[0], k);
                    });
                })(theCatgory1[0]);
            }
        }
        //其它大类
        if (id != "114" && id > 0)
        {	//一行
            var el = this._createElement('div', this.BR);
            el.className = 'HXDialogCateBR_line';
            el.innerHTML = '<div class="HXDialogCateBR_lineL" id="HXDialogCateBR_lineL_' + theCatgory0[0] + '"></div>' +
                    '<div class="HXDialogCateBR_lineR"><ul><ul></div>';
            //一行左边
            var el = this._createElement('span', this.$('HXDialogCateBR_lineL_' + theCatgory0[0]));
            el.title = el.innerHTML = theCatgory0[1];
            this._addEvent(el, "click", function () {
                _this.finalSel(theCatgory0[0]);
            });
            //一行右边
            for (var k in HXDialogCate1LIST[id])
            {
                var theCatgory1 = HXDialogCate1LIST[id][k];
                //一行
                var el = this._createElement('div', this.BR);
                el.className = 'HXDialogCateBR_line';
                el.innerHTML = '<div class="HXDialogCateBR_lineL" id="HXDialogCateBR_lineL_' + theCatgory1[0] + '"></div>' +
                        '<div class="HXDialogCateBR_lineR"><ul id="HXDialogCateBR_lineRUl_' + theCatgory1[0] + '"></ul></div>';
                //一行左边
                var el = this._createElement('span', this.$('HXDialogCateBR_lineL_' + theCatgory1[0]));
                el.title = el.innerHTML = theCatgory1[1];
                (function (k1) {
                    _this._addEvent(el, "click", function () {
                        _this.finalSel(theCatgory0[0], k1);
                    });
                })(theCatgory1[0]);
                //一行右边
                for (var kk in HXDialogCate2LIST[HXDialogCate1LIST[id][k][0]])
                {
                    var theCatgory2 = HXDialogCate2LIST[HXDialogCate1LIST[id][k][0]][kk];
                    var el = this._createElement('li', this.$('HXDialogCateBR_lineRUl_' + theCatgory1[0]));
                    el.innerHTML = '<a title="' + theCatgory2[1] + '" href="javascript:;">' + theCatgory2[1].substr(0, 6) + '</a>';
                    (function (k1, k2) {
                        _this._addEvent(el, "click", function () {
                            _this.finalSel(theCatgory0[0], k1, k2);
                        });
                    })(theCatgory1[0], theCatgory2[0]);
                }
            }
        }
    },
    finalSel: function (cid0, cid1, cid2) {
        var html = '';
        if (this.options.retLevel == null)
        {
            if (cid0 == 0)
                html += '全行业';
            if (cid0 > 0)
                html += HXDialogCate0LIST[cid0][1];
            if (cid0 > 0 && cid1 > 0)
                html += "-" + HXDialogCate1LIST[cid0][cid1][1];
            if (cid1 > 0 && cid2 > 0)
                html += "-" + HXDialogCate2LIST[cid1][cid2][1];
        } else {
            if (cid1 > 0 && cid2 > 0)
                html = HXDialogCate2LIST[cid1][cid2][1];
            else if (cid0 > 0 && cid1 > 0)
                html = HXDialogCate1LIST[cid0][cid1][1];
            else if (cid0 > 0)
                html = HXDialogCate0LIST[cid0][1];
            else if (cid0 == 0)
                html = '全行业';
        }
        if (this.OBJDF.type)
            this.OBJDF.value = html;
        else
            this.OBJDF.innerHTML = html;
        var selid = cid2 ? cid2 : (cid1 ? cid1 : cid0);
        this.OBJIF.value = selid;
        this.close();
    },
    ajax: function (objid, url) {
        var _this = this;
        var xmlhttp;
        if (window.XMLHttpRequest)
            xmlhttp = new XMLHttpRequest();
        else
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                try {
                    var data = eval("(" + xmlhttp.responseText + ")");
                } catch (ex) {
                    return;
                }
                if (data != null && objid != null && _this.$(objid) != null) {
                    _this.$(objid).innerHTML = '';
                    if (objid == 'HXDialogCateFastSearchResult' && data.length == 1)
                    {
                        var d = data[0];
                        _this.finalSel(d[0], d[1], d[2]);
                    }
                    else
                    {
                        for (var k = 0; k < data.length; k++)
                        {
                            var d = data[k];
                            var el = _this._createElement('li', _this.$(objid));
                            el.innerHTML = '<a title="' + d[4] + '" href="javascript:;">' + d[3] + '</a>';
                            (function (k0, k1, k2) {
                                _this._addEvent(el, "click", function () {
                                    _this.finalSel(k0, k1, k2);
                                });
                            })(d[0], d[1], d[2]);
                        }
                    }
                }
            }
            if (objid == 'HXDialogCateLastLogUl' && _this.$('HXDialogCateLastLog') != null)
            {
                if (data == null || data.length <= 0)
                    _this.$('HXDialogCateLastLog').style.display = 'none';
                else
                    _this.$('HXDialogCateLastLog').style.display = 'block';
            }
        }
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }
};
//装载CSS
document.write(HXDialogCateCSS);
//新版本创建
HXDialogCate.setup = function (options) {
    return new HXDialogCate(options);
}
//兼容旧版本创建
function category_select_create(inputField, displayField) {
    return new HXDialogCate({inputField: inputField, displayField: displayField});
}
