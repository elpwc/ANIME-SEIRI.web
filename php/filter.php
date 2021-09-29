<?php
                        $link = @mysqli_connect(HOST, USER, PASS, DBNAME) or die("提示：数据库连接失败！");
                        //mysqli_select_db($link, DBNAME);
                        mysqli_set_charset($link, 'utf8');

                        //WHERE后面的
                        $card_country =ConvertUtils::dbcountry($country);
                        $card_type = ConvertUtils::dbtype($type);
                        $card_housou_stat = ConvertUtils::dbstat($stat);
                        $card_year = $year;
                        $card_season = ConvertUtils::dbseason($season);
                        $card_epi_len_type = ConvertUtils::dbepi($len);
                        $card_len = ConvertUtils::dblen($len);


                        //$card_userstat = ConvertUtils::dbuserstat($userstat);
                        
                        class ConvertUtils
                        {
                            public static function dbcountry($co)
                            {
                                switch ($co) {
                            case 'ja':
                            return 0;
                            case 'zh-cn':
                            return 1;
                            case 'en':
                            return 2;
                            case 'ko':
                            return 3;
                            case 'zh-tw':
                            return 4;
                            case 'other':
                            return 5;
                            case ''://全部
                              return -2;
                            default://不存在
                            return -1;
                            }
                            }

                            public static function dbtype($co)
                            {
                                switch ($co) {
                            case 'tv':
                            return 0;
                            case 'web':
                            return 1;
                            case 'ova':
                            return 2;
                            case 'movie':
                            return 3;
                            case 'other':
                            return 4;
                            case ''://全部
                              return -2;
                            default:
                            return -1;
                            }
                            }

                            public static function dbseason($co)
                            {
                                switch ($co) {
                            case 'fuyu':
                            return 0;
                            case 'haru':
                            return 1;
                            case 'natsu':
                            return 2;
                            case 'aki':
                            return 3;
                            case ''://全部
                              return -2;
                            default:
                            return -1;
                            }
                            }

                            public static function dbepi($co)
                            {
                                switch ($co) {
                            case 'kanon':
                            return 0;
                            case 'keke':
                            return 1;
                            case 'chisato':
                            return 2;
                            case 'sumire':
                            return 3;
                            case 'ren':
                            return 4;
                            case ''://全部
                              return -2;
                            default:
                            return -1;
                            }
                            }

                            public static function dbstat($co)
                            {
                                switch ($co) {
                            case 'mami':
                            return 0;
                            case 'madoka':
                            return 1;
                            case 'sayaka':
                            return 2;
                            case 'homura':
                            return 3;
                            case 'kyouko':
                            return 4;
                            case ''://全部
                              return -2;
                            default:
                            return -1;
                            }
                            }

                            public static function dbuserstat($co)
                            {
                                switch ($co) {
                            case 'mitai':
                            return 0;
                            case 'nai':
                            return 1;
                            case 'mada':
                            return 2;
                            case 'owaru':
                            return 3;
                            case 'miteru':
                            return 4;
                            case 'akirameta':
                            return 5;
                            case 'ichou':
                              return 6;
                              case ''://全部
                                return -2;
                            default:
                            return -1;
                            }
                            }

                            public static function dblen($co)
                            {
                                switch ($co) {
                            case 'koizumi':
                            return 0;
                            case 'short':
                            return 1;
                            case 'normal':
                            return 2;
                            case 'long':
                            return 3;
                            case ''://全部
                              return -2;
                            default:
                            return -1;
                            }
                            }
                        }
                        $where = "";
                        $first = false;//已经有第一个
                        if ($card_country != '-2') {
                            if ($first == true) {
                                $where.=" AND";
                            }
                            $where.=" country = ".(string)$card_country;
                            $first = true;
                        }
                        if ($card_type != '-2') {
                            if ($first == true) {
                                $where.=" AND";
                            }
                            $where.=" type = ".(string)$card_type;
                            $first = true;
                        }
                        if ($card_housou_stat != '-2') {
                            if ($first == true) {
                                $where.=" AND";
                            }
                            $where.=" housou_stat = ".(string)$card_housou_stat;
                            $first = true;
                        }
                        if ($card_year != '') {
                            if ($first == true) {
                                $where.=" AND";
                            }
                            $where.=" year = ".(string)$card_year;
                            $first = true;
                        }
                        if ($card_season != '-2') {
                            if ($first == true) {
                                $where.=" AND";
                            }
                            $where.=" season = ".(string)$card_season;
                            $first = true;
                        }
                        if ($card_epi_len_type != '-2') {
                            if ($first == true) {
                                $where.=" AND";
                            }
                            $where.=" episode_type = ".(string)$card_epi_len_type;
                            $first = true;
                        }
                        if ($card_len != '-2') {
                            if ($first == true) {
                                $where.=" AND";
                            }
                            $where.=" len = ".(string)$card_len;
                            $first = true;
                        }

                        //排序
                        $where .=" ORDER BY bangumi_rank;";
                  
                        $sql = "SELECT COUNT(name) FROM anime WHERE".$where;
                        $count = mysqli_query($link, $sql)->fetch_array()[0];
                        
                        $sql = "SELECT name,ori_name,image_url,episode,year,id FROM anime WHERE".$where;
                        //echo($sql);
                        $result = mysqli_query($link, $sql);
                        
                        if ($count > 0) {
                            echo('<small class="text-muted">找到了'.(string)$count.'部作品！！！(ﾉﾟ▽ﾟ)ﾉ</small><br/>');
                        } else {
                            echo('
                          <div style="height: 200px; padding-top: 80px; text-align: center;">
                          <h5>没有找到符合的作品捏...(；´д｀)ゞ </h5><br/>
                          <a href="./index.php" target="_top">点这里随机展现一部作品捏</a>
                          </div>');
                        }
