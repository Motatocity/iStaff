<?

    function get_dcode($selopt) {
          include('condb.php');
          $sql = "SELECT code FROM kpi_cockpit.department WHERE id = '$selopt';";
          $result = $conn->query($sql);
          $row = $result->fetch_assoc();
          $conn->close();
          return $row['code'];
    }

    function combo_department_datamaster($selopt) {
          include('condb.php');
          $sql = "SELECT id,name FROM kpi_cockpit.department WHERE status = 1 ORDER BY name;";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  if($row['id'] == $selopt)
                      echo "<option value='datamaster.php?dep=".$row['id']."' selected='selected'>".$row['name']."</option>\n";
                  else
                      echo "<option value='datamaster.php?dep=".$row['id']."'>".$row['name']."</option>\n";
              }
          }
          $conn->close();
    }

    function combo_department_template($selopt) {
          include('condb.php');
          $sql = "SELECT id,name FROM kpi_cockpit.department WHERE status = 1 ORDER BY name;";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  if($row['id'] == $selopt)
                      echo "<option value='template.php?dep=".$row['id']."' selected='selected'>".$row['name']."</option>\n";
                  else
                      echo "<option value='template.php?dep=".$row['id']."'>".$row['name']."</option>\n";
              }
          }
          $conn->close();
    }

    function combo_department_admin($selopt) {
          include('condb.php');
          $sql = "SELECT id,name FROM kpi_cockpit.department WHERE status = 1 ORDER BY name;";
          $result = $conn->query($sql);
          echo "<option value='0'>----- เลือกหน่วยงาน -----</option>\n";
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  if($row['id'] == $selopt)
                      echo "<option value='".$row['id']."' selected='selected'>".$row['name']."</option>\n";
                  else
                      echo "<option value='".$row['id']."'>".$row['name']."</option>\n";
              }
          }
          $conn->close();
    }

    function combo_department_select($selopt) {
          include('condb.php');
          $sql = "SELECT id,name FROM kpi_cockpit.department WHERE status = 1 ORDER BY name;";
          $result = $conn->query($sql);
          echo "<option value='".$row['id']."'>----- เลือกหน่วยงาน -----</option>\n";
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  if($row['id'] == $selopt)
                      echo "<option value='".$row['id']."' selected='selected'>".$row['name']."</option>\n";
                  else
                      echo "<option value='".$row['id']."'>".$row['name']."</option>\n";
              }
          }
          $conn->close();
    }

    function combo_datefilter_kpivalue($month) {
          $montharr = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
          $i = 1;
          foreach ($montharr as $value) {
            if($i == $month)
                echo "<option value='".sprintf("%02d", $i)."' selected='selected'>".$montharr[$i-1]."</option>\n";
            else
                echo "<option value='".sprintf("%02d", $i)."'>".$montharr[$i-1]."</option>\n";
            $i++;
          }
    }

    function table_datamaster($department) {
          include('condb.php');
          $sql = "SELECT code,name,type,u_date FROM kpi_cockpit.datamaster WHERE departmentid = $department AND status = 1 ORDER BY code ASC;";
          $result = $conn->query($sql);
          $i = 1;
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                $dtype = ($row['type'] == 1)?"General Data":"HN Data";
                echo "<tr>\n";
                echo "  <td>$i</td>\n";
                echo "  <td><a href='#data' name='".$row['code']."' ng-click=\"setUpdate('".$row['code']."')\">".$row['code']."</a></td>\n";
                echo "  <td>".$row['name']." <small><i>(".$row['u_date'].")</i></small></td>\n";
                echo "  <td><center><span class='badge bg-blue'>".$dtype."</span></center></td>\n";
                echo "</tr>\n";
                $i++;
              }
          }
          $conn->close();
    }

    function table_template($department) {
          include('condb.php');
          $sql = "SELECT code,name,replace(target,'[X]','') AS 'target',u_date FROM kpi_cockpit.kpi_templete WHERE departmentid = $department AND status = 1;";
          $result = $conn->query($sql);
          $i = 1;
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo "<tr>\n";
                echo "  <td>$i</td>\n";
                echo "  <td><a href='#data' name='".$row['code']."' ng-click=\"setUpdate('".$row['code']."')\">".$row['code']."</a></td>\n";
                echo "  <td>".$row['name']." <small><i>(".$row['u_date'].")</i></small></td>\n";
                echo "  <td><center><span class='badge bg-green'>".$row['target']."</span></center></td>\n";
                echo "</tr>\n";
                $i++;
              }
          }
          $conn->close();
    }

    function get_display_user($user) {
          include('condb.php');
          $ans = "";
          $sql = "SELECT display FROM kpi_cockpit.user WHERE usrname = '$user';";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  $ans = $row['display'];
              }
          }
          $conn->close();
          return $ans;
    }

    function get_image_user($user) {
          include('condb.php');
          $ans = "";
          $sql = "SELECT image FROM kpi_cockpit.user WHERE usrname = '$user';";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  $ans = $row['image'];
              }
          }
          $conn->close();
          return $ans;
    }

    function get_position_user($user) {
          include('condb.php');
          $ans = "";
          $sql = "SELECT position FROM kpi_cockpit.user WHERE usrname = '$user';";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  $ans = $row['position'];
              }
          }
          $conn->close();
          return $ans;
    }

    function get_department_name($id) {
          include('condb.php');
          $ans = "";
          $sql = "SELECT name FROM kpi_cockpit.department WHERE id = $id;";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  $ans = $row['name'];
              }
          }
          $conn->close();
          return $ans;
    }

    function admin_board_view($month,$year) {
          include('condb.php');
          $sql = "SELECT id,name FROM kpi_cockpit.department WHERE status = 1;";
          $r = $conn->query($sql);
          if ($r->num_rows > 0) {
              while($dep = $r->fetch_assoc()) {
                  if(admin_kpi_unsaved_count($dep['id'],$month,$year) > 0)
                  {
                      echo "<div class=\"box box-danger\">\n";
                      echo "  <div class=\"box-header with-border\">\n";
                      echo "    <h3 class=\"box-title\">".$dep['name']."</h3>\n";
                      echo "    <div class=\"box-tools pull-right\">\n";
                      echo "      <button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"collapse\"><i class=\"fa fa-minus\"></i></button>\n";
                      echo "    </div>\n";
                      echo "  </div>\n";
                      echo "  <div class=\"box-body\">\n";
                      echo "     ".admin_kpi_unsaved($dep['id'],$month,$year)."\n";
                      echo "  </div>\n";
                      echo "</div>\n";
                  }
              }
          }
          $conn->close();
    }

    function admin_kpi_unsaved_count($department,$month,$year) {
          include('condb.php');
          $sql = "SELECT m.code, m.name, m.unit FROM kpi_cockpit.datamaster m LEFT JOIN (SELECT code FROM kpi_cockpit.data_raw WHERE u_date LIKE '".$year."-".$month."-%') d ON m.code = d.code WHERE d.code IS NULL AND m.departmentid = ".$department." AND m.type = 1 AND m.status = 1;";
          $result = $conn->query($sql);
          $ans = $result->num_rows;
          $conn->close();
          return $ans;
    }

    function admin_kpi_unsaved($department,$month,$year) {
          include('condb.php');
          $sql = "SELECT m.code, m.name, m.unit FROM kpi_cockpit.datamaster m LEFT JOIN (SELECT code FROM kpi_cockpit.data_raw WHERE u_date LIKE '".$year."-".$month."-%') d ON m.code = d.code WHERE d.code IS NULL AND m.departmentid = ".$department." AND m.type = 1 AND m.status = 1;";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo "<div class=\"form-group\">\n";
                  echo "  <label class=\"col-xs-12 control-label-left\"><label class=\"text-red\">[".$row['code']."]</label> ".$row['name']."</label>\n";
                  echo "</div>\n\n";
              }
          }
          $conn->close();
    }

    function input_kpi_unsaved($department,$month,$year) {
          include('condb.php');
          $ytd_day = date("j", strtotime("first day of previous month"));
          $ytd_month = date("n", strtotime("first day of previous month"));
          $ytd_year = date("Y", strtotime("first day of previous month"));
          $sql = "SELECT DISTINCT m.code, m.name, m.unit FROM kpi_cockpit.datamaster m LEFT JOIN (SELECT code FROM kpi_cockpit.data_raw WHERE u_date LIKE '".$year."-".$month."-%') d ON m.code = d.code WHERE d.code IS NULL AND m.departmentid = ".$department." AND m.type = 1 AND m.status = 1 ORDER BY m.code;";
		  $result = $conn->query($sql);
          $txtname = "";
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo "<div class=\"form-group\">\n";
                echo "  <label class=\"col-md-9 col-xs-12 control-label-left\"><label class=\"text-red\">[".$row['code']."]</label> ".$row['name']."</label>\n";
                echo "  <div class=\"col-md-2 col-xs-8\">\n";
                echo "    <input type=\"text\" name=\"kpivalue[]\" class=\"form-control\" value=\"\" ".enable_form_month($month,$year).">\n";
                echo "  </div>\n";
                echo "  <label class=\"col-md-1 col-xs-2 control-label-left\">".$row['unit']."</label>\n";
                echo "</div>\n\n";
                $txtname .= $row['code'].",";
              }
              echo "<input type=\"hidden\" name=\"txtname\" value=\"".$txtname."\">\n";
          }
          $conn->close();
    }

    function input_kpi_saved($department,$month,$year) {
          include('condb.php');
          $sql = "SELECT DISTINCT m.code, m.name, m.unit, d.u_date, d.value FROM kpi_cockpit.datamaster m JOIN kpi_cockpit.data_raw d ON m.code = d.code WHERE d.u_date LIKE '".$year."-".$month."-%' AND m.departmentid = ".$department." AND m.type = 1 AND m.status = 1 ORDER BY m.code;";
          $result = $conn->query($sql);
          $txtname = "";
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo "<div class=\"form-group\">\n";
                echo "  <label class=\"col-md-9 col-xs-12 control-label-left\"><label class=\"text-green\">[".$row['code']."]</label> ".$row['name']."<br><small><i>(".$row['u_date'].")</i></small></label>\n";
                echo "  <div class=\"col-md-2 col-xs-8\">\n";
                echo "    <input type=\"text\" name=\"kpivalue[]\" class=\"form-control\" value=\"".$row['value']."\" ".enable_form_month($month,$year).">\n";
                echo "  </div>\n";
                echo "  <label class=\"col-md-1 col-xs-2 control-label-left\">".$row['unit']."</label>\n";
                echo "</div>\n\n";
                $txtname .= $row['code'].",";
              }
              echo "<input type=\"hidden\" name=\"txtname\" value=\"".$txtname."\">\n";
          }
          $conn->close();
    }

    function input_kpi_hn($department,$month,$year) {
          include('condb.php');
          $sql = "SELECT m.code,name,IFNULL(n,0) AS 'n' FROM kpi_cockpit.datamaster m LEFT JOIN (SELECT code,COUNT(*) AS 'n' FROM kpi_cockpit.data_hn WHERE u_date LIKE '".$year."-".$month."-%' AND departmentid = ".$department." GROUP BY code) d ON m.code = d.code WHERE type = 2 AND departmentid = ".$department." AND status = 1 ORDER BY m.code;";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo "<div class=\"form-group\">\n";
                echo "  <label class=\"col-md-9 col-xs-12 control-label-left\"><label class=\"text-yellow\">[".$row['code']."]</label> ".$row['name']." <span class=\"badge\"> ".$row['n']." คน</span></label>\n";
                echo "  <div class=\"col-md-2 col-xs-8\">\n";
                echo "    <div class=\"input-group\">\n";
                echo "      <span class=\"input-group-addon\">HN</span>\n";
                echo "      <input type=\"text\" id=\"".$row['code']."\" name=\"".$row['code']."\" class=\"form-control\" value=\"\" ".enable_form_month($month,$year).">\n";
                echo "    </div>\n";
                echo "  </div>\n";
                echo "  <label class=\"btn btn-warning\" onclick=\"savehn('".$row['code']."',document.getElementById('".$row['code']."').value)\" ".enable_form_month($month,$year)."><i class=\"fa fa-fw fa-plus-circle\"></i> เพิ่ม</label>\n";
                echo "</div>\n\n";
              }
          }
          $conn->close();
    }

    function last_saved_hncounting($department,$month,$year) {
          include('condb.php');
          $sql = "SELECT r.u_date FROM kpi_cockpit.datamaster m JOIN kpi_cockpit.data_raw r ON m.departmentid = r.departmentid WHERE m.departmentid = $department AND m.type = 2 AND r.u_date LIKE '$year-$month-%' GROUP BY r.code ORDER BY r.u_date DESC;";
          $result = $conn->query($sql);
          $ans = "";
          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $ans = "บันทึกล่าสุดเมื่อ ".$row['u_date'];
          }
          return $ans;
          $conn->close();
    }

    function name_kpi_hn($department) {
          include('condb.php');
          $sql = "SELECT code FROM kpi_cockpit.datamaster WHERE type = 2 AND departmentid = ".$department." AND status = 1;";
          $result = $conn->query($sql);
          $ans = "";
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                $ans .= $row['code'].",";
              }
          }
          echo $ans;
          $conn->close();
    }

    function enable_form_month($month,$year) {
        $now_day = date("d");
        $now_month = date("m");
        $now_year = date("Y");

        $ytd_day = date("j", strtotime("first day of previous month"));
        $ytd_month = date("n", strtotime("first day of previous month"));
        $ytd_year = date("Y", strtotime("first day of previous month"));
        /*
        if($now_month != $month || $now_year != $year){
            return "disabled";
        }
        */
        //if(($now_month == $month && $now_year == $year) || ($now_day <= 15 && ($now_month - 1) == $month)){
        if($ytd_month == $month && $ytd_year == $year && $now_day <= 15){
            return "";
        } else {
            return "disabled";
        }
    }

    function enable_form_admin($user) {
        include('condb.php');
        $sql = "SELECT type FROM kpi_cockpit.user WHERE usrname = ".$user." AND status = 1;";
        $result = $conn->query($sql);
        $ans = "";
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if($row['type'] != "admin"){
                echo "disabled";
            } else {
                echo "";
            }
        }
        $conn->close();
    }

    function analysis_saved_rate($department,$month,$year) {
        include('condb.php');
        $sql = "SELECT COUNT(*) AS 'n_all' FROM kpi_cockpit.datamaster WHERE departmentid = ".$department." AND status = 1;";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $all = $row['n_all'];

        $sql = "SELECT COUNT(*) AS 'n_submit' FROM kpi_cockpit.data_raw WHERE departmentid = ".$department." AND u_date LIKE '".$year."-".$month."-%' AND status = 1;";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $n_submit = $row['n_submit'];

        return $n_submit." / ".$all;
        $conn->close();
    }

    function unsave_counting($department,$month,$year) {
        include('condb.php');
        $sql = "SELECT COUNT(*) AS 'n_all' FROM kpi_cockpit.datamaster WHERE departmentid = ".$department." AND status = 1;";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $all = $row['n_all'];

        $sql = "SELECT COUNT(*) AS 'n_submit' FROM kpi_cockpit.data_raw WHERE departmentid = ".$department." AND u_date LIKE '".$year."-".$month."-%' AND status = 1;";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $n_submit = $row['n_submit'];

        return ($all - $n_submit);
        $conn->close();
    }

    function saved_ratio($department,$month,$year) {
        include('condb.php');
        $sql = "SELECT COUNT(*) AS 'n_all' FROM kpi_cockpit.datamaster WHERE departmentid = ".$department." AND status = 1;";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $all = $row['n_all'];

        $sql = "SELECT COUNT(*) AS 'n_submit' FROM kpi_cockpit.data_raw WHERE departmentid = ".$department." AND u_date LIKE '".$year."-".$month."-%' AND status = 1;";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $n_submit = $row['n_submit'];

        return ($n_submit/$all)*100;
        $conn->close();
    }

    function kpi_counting($department,$month,$year) {
        include('condb.php');
        $nkpi_success = 0;
        $nkpi_fail = 0;
        $nkpi_all = 0;
        $sql = "SELECT code FROM kpi_cockpit.kpi_templete WHERE departmentid = $department AND status = 1;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $sql2 = "SELECT code,name,target FROM kpi_cockpit.kpi_templete WHERE code = '".$row['code']."' AND departmentid = $department AND status = 1;";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    $row2 = $result2->fetch_assoc();
                    $target = $row2['target'];
                    $kpi_now = analysis_kpi($row['code'],$department,$month,$year);
                    $kpi_now = (($kpi_now == '') ? '0' : $kpi_now);
                    $formula_target = str_replace("[X]",$kpi_now,$target);
                    $ansbool = @eval('return '.$formula_target.';');

                    if($kpi_now == "null"){
                       $kpi_now = "-";
                       $ansbool = -1;
                    } else {
                        $ansbool = @eval('return '.$formula_target.';');
                    }

                    if($ansbool == 1){
                        $nkpi_success++;
                    } elseif($ansbool == 0 && $kpi_now != "N/A") {
                        $nkpi_fail++;
                    }
                    $nkpi_all++;
                }
            }
        }
        $arr = array("all" => $nkpi_all,"success" => $nkpi_success,"fail" => $nkpi_fail);
        $conn->close();
        return $arr;
    }

    function analysis_kpi($kpicode,$department,$month,$year) {
        include('condb.php');
        $sql = "SELECT * FROM kpi_cockpit.kpi_templete WHERE code = '$kpicode' AND status = 1;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $formula = $row['formula'];
            preg_match_all('/\[(.*?)\]/', $formula, $out);
            $arrcode = $out[1];
            foreach ($arrcode as $value) {
                //$sql = "SELECT code,value,u_date FROM kpi_cockpit.data_raw WHERE code = '$value' AND (departmentid = $department OR departmentid = 0) AND u_date LIKE '$year-$month-%' AND status = 1;";
                $sql = "SELECT code,value,u_date FROM kpi_cockpit.data_raw WHERE code = '$value' AND u_date LIKE '$year-$month-%' AND status = 1;";
                $result = $conn->query($sql);

        				if ($result->num_rows > 0) {
        					   $row = $result->fetch_assoc();
        				} else {
        					$sql = "SELECT code,COUNT(*) AS 'value',u_date FROM kpi_cockpit.data_hn WHERE code = '$value' AND u_date LIKE '$year-$month-%' AND status = 1;";
        					$result = $conn->query($sql);
          					if ($result->num_rows > 0) {
          					   $row = $result->fetch_assoc();
							    if ($value[0] == 'K') {
									$row['value'] = analysis_kpi($value,$department,$month,$year);
								} else {
									return "null";
								}
          					}
        				}
                $formula = str_replace("[".$value."]",$row['value'],$formula);
				if($row['value'] == "-") {
					return "N/A";
				}
            }

			if (strpos($formula, 'null') !== false) {
				return "null";
			}

            try {
                $ans = @eval('return '.$formula.';');
                if($ans != 0){
                  $ans = number_format($ans,2,'.','');
                }
            } catch (Exception $e) {
                $ans = "null";
            }
            return $ans;
        } else {
            return "null";
        }
        $conn->close();
    }

    function analysis_block($kpicode,$department,$month,$year) {
        include('condb.php');
        $sql = "SELECT code,name,target,target_desc FROM kpi_cockpit.kpi_templete WHERE code = '$kpicode' AND departmentid = $department AND status = 1;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $today = new DateTime($year.'-'.$month.'-01');
            $today->modify('-1 month');
            $target = $row['target'];
            $target_desc = $row['target_desc'];
            $lastmonth = $today->format('m');
            $lastyear = $today->format('Y');
            $kpi_older = analysis_kpi($kpicode,$department,$lastmonth,$lastyear);
            $kpi_now = analysis_kpi($kpicode,$department,$month,$year);
            $kpi_diff = ($kpi_now - $kpi_older);
            $kpi_now = (($kpi_now == '') ? '0' : $kpi_now);
            $formula_target = str_replace("[X]",$kpi_now,$target);
            if($kpi_now == "null"){
               $kpi_now = "-";
                $ansbool = 0;
            } else {
                $ansbool = @eval('return '.$formula_target.';');
            }

            if($kpi_now == "N/A") {
                $ansbool = "orange";
            } elseif($ansbool == 1){
                $ansbool = "green";
                $nkpi_success++;
            } elseif($kpi_now == "-") {
                $ansbool = "gray";
            } else {
                $ansbool = "red";
                $nkpi_fail++;
            }
            $nkpi_all++;

            if($kpi_diff > 0){
                $sign = "+";
                $icon = "fa fa-caret-up";
				$icon_margin = "margin-top: 10px;";
                $value = " (".$sign.$kpi_diff.")";
            } elseif($kpi_diff < 0) {
                $sign = "";
                $icon = "fa fa-caret-down";
				$icon_margin = "margin-top: 10px;";
                $value = " (".$sign.$kpi_diff.")";
            } else {
                $value = "";
				$icon_margin = "";
                $icon = "fa fa-sort";
            }

			$target_word = str_replace(" ","",$target_desc);
			//$target_word = str_replace("[X]","target",$target_word);
      $target_word = "target: ".$target_word;
			$target_word = str_replace("=="," = ",$target_word);
			$target_word = str_replace(">="," &ge; ",$target_word);
			$target_word = str_replace("<="," &le; ",$target_word);
			$target_word = str_replace("!="," &ne; ",$target_word);
			$target_word = str_replace(">"," > ",$target_word);
			$target_word = str_replace("<"," < ",$target_word);

            $conn->close();
            echo "<tag>\n";
            echo "<a href=\"kpidetail.php?month=$month&code=$kpicode&year=$year\">\n";
            echo "<div class=\"col-lg-6 col-md-6 col-xs-12\">\n";
            echo "  <div class=\"info-box bg-".$ansbool."\">\n";
            echo "    <span class=\"info-box-icon\"><i class=\"$icon\" style=\"$icon_margin\"><h5 style=\"margin-bottom: 0px;margin-top: 0px;\"><b>$value</b></h5></i></span>\n";
            echo "    <div class=\"info-box-content\">\n";
            echo "      <span class=\"info-box-kpi\">$kpi_now <small>($target_word)</small></span>\n";
            echo "    	<div class=\"progress\">\n";
            echo "    		<div class=\"progress-bar\" style=\"width: 70%\"></div>\n";
            echo "    	</div>\n";
            echo "      <span class=\"progress-description\">\n";
            echo "         ".$row['name']."\n";
            echo "      </span>\n";
            echo "    </div>\n";
            echo "  </div>\n";
            echo "</div>\n";
            echo "</a>\n";
            echo "</tag>\n";
        }
    }

    function analysis_block_detail($kpicode,$department,$month,$year) {
        include('condb.php');
        $sql = "SELECT code,name,target,target_desc,unit FROM kpi_cockpit.kpi_templete WHERE code = '$kpicode' AND status = 1;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $today = new DateTime($year.'-'.$month.'-01');
            $today->modify('-1 month');
            $target = $row['target'];
            $target_desc = $row['target_desc'];
            $lastmonth = $today->format('m');
            $lastyear = $today->format('Y');
            $kpi_older = analysis_kpi($kpicode,$department,$lastmonth,$lastyear);
            $kpi_now = analysis_kpi($kpicode,$department,$month,$year);
            $kpi_diff = ($kpi_now - $kpi_older);
            $kpi_now = (($kpi_now == '') ? '0' : $kpi_now);
            $formula_target = str_replace("[X]",$kpi_now,$target);
            if($kpi_now == "null"){
               $kpi_now = "-";
                $ansbool = 0;
            } else {
                $ansbool = @eval('return '.$formula_target.';');
            }

            if($kpi_now == "N/A") {
                $ansbool = "orange";
            } elseif($ansbool == 1){
                $ansbool = "green";
                $nkpi_success++;
            } elseif($kpi_now == "-") {
                $ansbool = "gray";
            } else {
                $ansbool = "red";
                $nkpi_fail++;
            }
            $nkpi_all++;

            if($kpi_diff > 0){
                $sign = "+";
                $icon = "fa fa-caret-up";
                $value = " (".$sign.$kpi_diff.")";
            } elseif($kpi_diff < 0) {
                $sign = "";
                $icon = "fa fa-caret-down";
                $value = " (".$sign.$kpi_diff.")";
            } else {
                $value = "";
                $icon = "fa fa-sort";
            }

            $target_word = str_replace(" ","",$target_desc);
      			//$target_word = str_replace("[X]","target",$target_word);
            $target_word = "target: ".$target_word;
      			$target_word = str_replace("=="," = ",$target_word);
      			$target_word = str_replace(">="," &ge; ",$target_word);
      			$target_word = str_replace("<="," &le; ",$target_word);
      			$target_word = str_replace("!="," &ne; ",$target_word);
      			$target_word = str_replace(">"," > ",$target_word);
      			$target_word = str_replace("<"," < ",$target_word);

            $conn->close();
            echo "  <div class=\"info-box bg-".$ansbool."\">\n";
            echo "    <span class=\"info-box-icon\"><i class=\"$icon\"></i></span>\n";
            echo "    <div class=\"info-box-content\">\n";
            echo "      <span class=\"info-box-kpi\">$kpi_now <small>($target_word)</small></span>\n";
            echo "      <div class=\"progress\">\n";
            echo "        <div class=\"progress-bar\" style=\"width: 70%\"></div>\n";
            echo "      </div>\n";
            echo "          <span class=\"progress-description\">\n";
            echo "            ".$row['name']."\n";
            echo "          </span>\n";
            echo "    </div>\n";
            echo "  </div>\n";
        }
    }

    function analysis_kpiboard($department,$month,$year) {
          include('condb.php');
          $sql = "SELECT code FROM kpi_cockpit.kpi_templete WHERE departmentid = $department AND status = 1;";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  analysis_block($row['code'],$department,$month,$year);
              }
          }
          $conn->close();
    }

    function admin_kpiboard($month,$year) {
          include('condb.php');
          $sql = "SELECT code,departmentid FROM kpi_cockpit.kpi_templete WHERE status = 1 GROUP BY code;";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  analysis_block($row['code'],$row['departmentid'],$month,$year);
              }
          }
          $conn->close();
    }

    function get_kpiname($kpicode) {
          include('condb.php');
          $sql = "SELECT code,name FROM kpi_cockpit.kpi_templete WHERE code = '$kpicode' AND status = 1;";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              return $row['name'];
          }
          $conn->close();
    }

    function kpidetail_history($code,$department,$monthselect,$yearselect) {
          $today = new DateTime($yearselect.'-'.$monthselect.'-01');
          $old = new DateTime($yearselect.'-'.$monthselect.'-01');
          $old->modify('-1 month');
          $monthold = $old->format('m');
          $yearold = $old->format('Y');
          $montharr = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
          for($i=0;$i<12;$i++){
              $kpi = analysis_kpi($code,$department,$monthselect,$yearselect);
              $kpi_old = analysis_kpi($code,$department,$monthold,$yearold);
              $old->modify('-1 month');
              $monthold = $old->format('m');
              $yearold = $old->format('Y');
              if($kpi > $kpi_old && $kpi != ""){
                  echo "<tr>\n";
                  echo "  <td>".($i+1).".</td>\n";
                  echo "  <td>".$montharr[intval($monthselect)-1]." ".$yearselect."</td>\n";
                  echo "  <td><center><span class=\"badge bg-green\"><i class=\"fa fa-caret-up\"></i> $kpi</span></center></td>\n";
                  echo "</tr>\n";
              } elseif($kpi < $kpi_old && $kpi != "") {
                  echo "<tr>\n";
                  echo "  <td>".($i+1).".</td>\n";
                  echo "  <td>".$montharr[intval($monthselect)-1]." ".$yearselect."</td>\n";
                  echo "  <td><center><span class=\"badge bg-red\"><i class=\"fa fa-caret-down\"></i> $kpi</span></center></td>\n";
                  echo "</tr>\n";
              } elseif($kpi == $kpi_old && $kpi != "") {
                  echo "<tr>\n";
                  echo "  <td>".($i+1).".</td>\n";
                  echo "  <td>".$montharr[intval($monthselect)-1]." ".$yearselect."</td>\n";
                  echo "  <td><center><span class=\"badge\">$kpi</span></center></td>\n";
                  echo "</tr>\n";
              }

              $today->modify('-1 month');
              $monthselect = $today->format('m');
              $yearselect = $today->format('Y');
          }
    }

    function kpidetail_history_chart($code,$department,$monthselect,$yearselect) {
          $today = new DateTime($yearselect.'-'.$monthselect.'-01');
          $montharr = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
          $axis = array();
          $ayis = array();
          for($i=0;$i<12;$i++){
              $kpi = analysis_kpi($code,$department,$monthselect,$yearselect);
              if($kpi != ""){
                  array_push($axis,$montharr[intval($monthselect)-1]." ".$yearselect);
                  array_push($ayis,$kpi);
              }
              $today->modify('-1 month');
              $monthselect = $today->format('m');
              $yearselect = $today->format('Y');
          }

          echo "var areaChartData = {\n";
          echo "  labels: [";
          $axis = array_reverse($axis);
          foreach($axis as $x) {
              echo "\"$x\",";
          }
          echo "],\n";
          echo "  datasets: [\n";
          echo "    {\n";
          echo "      label: \"$code\",\n";
          echo "      fillColor: \"rgba(60,141,188,0.9)\",\n";
          echo "      strokeColor: \"rgba(60,141,188,0.8)\",\n";
          echo "      pointColor: \"#3b8bba\",\n";
          echo "      pointStrokeColor: \"rgba(60,141,188,1)\",\n";
          echo "      pointHighlightFill: \"#fff\",\n";
          echo "      pointHighlightStroke: \"rgba(60,141,188,1)\",\n";
          echo "      data: [";
          $ayis = array_reverse($ayis);
          foreach($ayis as $y) {
              echo "$y,";
          }
          echo "]\n";
          echo "    }\n";
          echo "  ]\n";
          echo "};\n";
    }

    function kpidetail_factor($kpicode,$department,$month,$year) {
        include('condb.php');
        $sql = "SELECT * FROM kpi_cockpit.kpi_templete WHERE code = '$kpicode' AND status = 1;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $formula = $row['formula'];
            preg_match_all('/\[(.*?)\]/', $formula, $out);
            $arrcode = $out[1];
            $i = 1;
            foreach ($arrcode as $value) {
                $sql = "SELECT r.code,m.name,d.name AS 'department',value,m.unit,r.u_date FROM kpi_cockpit.data_raw r JOIN kpi_cockpit.datamaster m ON r.code = m.code ";
                $sql .= "JOIN kpi_cockpit.department d ON r.departmentid = d.id ";
                $sql .= "WHERE r.code = '$value' AND r.u_date LIKE '$year-$month-%' AND r.status = 1 AND m.status = 1;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
                    echo "<tr>\n";
                    echo "  <td>$i.</td>\n";
                    echo "  <td>".$row['code']."</td>\n";
                    echo "  <td>".$row['name']." <br><small><i>(".$row['u_date'].")</i></small></td>\n";
                    echo "  <td>".$row['department']."</td>\n";
                    echo "  <td><center><span class=\"badge bg-blue\">".$row['value']." ".$row['unit']."</span></center></td>\n";
                    echo "</tr>\n";
                    $i++;
                } else {
					$sql = "SELECT r.code,m.name,d.name AS 'department',COUNT(*) AS 'value',m.unit,r.u_date FROM kpi_cockpit.data_hn r JOIN kpi_cockpit.datamaster m ON r.code = m.code ";
					$sql .= "JOIN kpi_cockpit.department d ON r.departmentid = d.id ";
					$sql .= "WHERE r.code = '$value' AND r.u_date LIKE '$year-$month-%' AND r.status = 1 AND m.status = 1 HAVING COUNT(*) > 0;";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						$row = $result->fetch_assoc();
						echo "<tr>\n";
						echo "  <td>$i.</td>\n";
						echo "  <td>".$row['code']."</td>\n";
						echo "  <td>".$row['name']." <br><small><i>(".$row['u_date'].")</i></small></td>\n";
						echo "  <td>".$row['department']."</td>\n";
						echo "  <td><center><span class=\"badge bg-blue\">".$row['value']." ".$row['unit']."</span></center></td>\n";
						echo "</tr>\n";
						$i++;
					} else {
						$analysis_kpi_value = analysis_kpi($value,$department,$month,$year);
						$analysis_kpi_name = get_kpiname($value);
						$analysis_kpi_department = get_department_name($department);
						$sql = "SELECT code,name,unit FROM kpi_cockpit.kpi_templete WHERE code = '$value';";
						$result = $conn->query($sql);
						if ($analysis_kpi_value != null) {
							$row = $result->fetch_assoc();
							echo "<tr>\n";
							echo "  <td>$i.</td>\n";
							echo "  <td>".$value."</td>\n";
							echo "  <td>".$analysis_kpi_name." <br><small><i>("."DATE".")</i></small></td>\n";
							echo "  <td>".$analysis_kpi_department."</td>\n";
							echo "  <td><center><span class=\"badge bg-blue\">".$analysis_kpi_value." ".$row['unit']."</span></center></td>\n";
							echo "</tr>\n";
							$i++;
						}
					}
                }
            }
        }
        $conn->close();
    }

    function comment_list($kpicode,$user,$month,$year) {
          include('condb.php');
          $sql = "SELECT c.u_date,c.comment,user,display,image FROM kpi_cockpit.comment c JOIN kpi_cockpit.user u ON c.user = u.usrname ";
          $sql .= "WHERE c.kpicode = '$kpicode' AND c.kpi_month = '$month' AND c.kpi_year = '$year' AND c.status = 1 ORDER BY c.u_date ASC;";
          $result = $conn->query($sql);
          $color = "online";
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  if($row['user'] == $user){
                      $color = "me";
                  } else {
                      $color = "online";
                  }
                  echo "<!-- chat item -->\n";
                  echo "<div class=\"item\">\n";
                  echo "    <img src=\"".$row['image']."\" alt=\"user image\" class=\"$color\">\n";
                  echo "    <p class=\"message\">\n";
                  echo "        <a href=\"#\" class=\"name\">\n";
                  echo "            <small class=\"text-muted pull-right\"><i class=\"fa fa-clock-o\"></i> ".$row['u_date']."</small>\n";
                  echo "            ".$row['display']."\n";
                  echo "        </a>\n";
                  echo "        ".$row['comment']."\n";
                  echo "    </p>\n";
                  echo "</div>\n";
                  echo "<!-- /.item -->\n";
              }
          }
          echo $ans;
          $conn->close();
    }

    function comment_list_all($departmentid,$month,$year) {
          include('condb.php');
          $sql = "SELECT k.code,comment,k.name,c.user,display,image,c.u_date FROM kpi_cockpit.comment c JOIN kpi_cockpit.kpi_templete k ON c.kpicode = k.code ";
          $sql .= "JOIN kpi_cockpit.user u ON u.usrname = c.user ";
          $sql .= "WHERE k.departmentid = $departmentid AND c.kpi_month = '$month' AND c.kpi_year = '$year' AND c.status = 1 ORDER BY c.u_date DESC;";
          $result = $conn->query($sql);
          $color = "online";
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  if($row['user'] != $_SESSION["usr"]){
                      echo "<!-- chat item -->\n";
                      echo "<div class=\"item\">\n";
                      echo "    <img src=\"".$row['image']."\" alt=\"user image\" class=\"$color\">\n";
                      echo "    <p class=\"message\">\n";
                      echo "        <a href=\"kpidetail.php?code=".$row['code']."\" class=\"name\">\n";
                      echo "            <small class=\"text-muted pull-right\"><i class=\"fa fa-clock-o\"></i> ".$row['u_date']."</small>\n";
                      echo "            ".$row['display']." - <small>[ ".$row['code']." | ".$row['name']." ]</small> \n";
                      echo "        </a>\n";
                      echo "        ".$row['comment']."\n";
                      echo "    </p>\n";
                      echo "</div>\n";
                      echo "<!-- /.item -->\n";
                }
              }
          }
          echo $ans;
          $conn->close();
    }

    function news_list($departmentid,$month,$year) {
          include('condb.php');
          $sql = "SELECT topic,url,u_date FROM kpi_cockpit.newslist WHERE (departmentid = $departmentid OR departmentid = 99) AND status = 1 ORDER BY id DESC";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo "<li>\n";
                  echo "      <span class=\"handle\">\n";
                  echo "        <i class=\"fa fa-ellipsis-v\"></i>\n";
                  echo "        <i class=\"fa fa-ellipsis-v\"></i>\n";
                  echo "      </span>\n";
                  echo "  <span class=\"text\">".$row['topic']."</span>\n";
                  $date_topic = new DateTime($row['u_date']);
                  $month_topic = $date_topic->format('m');
                  $year_topic = $date_topic->format('Y');
                  if($month_topic == date("m") && $year_topic == date("Y")) {
                      echo "  <small class=\"label label-success\">NEW</small>\n";
                  }
                  echo "</li>\n";
              }
          }
          echo $ans;
          $conn->close();
    }

?>
