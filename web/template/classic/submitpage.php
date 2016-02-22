<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $view_title ?></title>
    <link rel=stylesheet href='./template/<?php echo $OJ_TEMPLATE ?>/<?php echo isset($OJ_CSS) ? $OJ_CSS : "hoj.css" ?>' type='text/css'>
    <script src="include/checksource.js"></script>
</head>

<body>
<div id="wrapper">
    <?php require_once("oj-header.php"); ?>
    <div id="main">
        <form id="frmSolution" action="submit.php" method="post" onsubmit = "return checksource(document.getElementById('source').value);"
            <?php if (isset($id)){
                echo "<div><label>Problem </label> <span class='blue'> <b>$id></b> </span >";
            }else {
                $PID = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                if ($pid > 25) $pid = 25;
                echo "<div><label>Problem </label>
                        <span class='blue'> <b> <a href='problem.php?cid=$cid&pid=$pid>$PID[$pid]</a></b></span>
                        of Contest<span class='blue ><b><a href='contest.php?cid=$cid>$cid</a></b></span>"
            }
    ?>
        <div>
            <label>Language:</label>
            <select id="language" name="language">
                <?php
                $lang_count = count($language_ext);
                if (isset($_GET['langmask']))
                    $langmask = $_GET['langmask'];
                else
                    $langmask = $OJ_LANGMASK;
                $lang = (~((int)$langmask)) & ((1 << ($lang_count)) - 1);
                if (isset($_COOKIE['lastlang']))
                    $lastlang = $_COOKIE['lastlang'];
                else
                    $lastlang = 0;
                for ($i = 0; $i < $lang_count; $i++) {
                    if ($lang & (1 << $i))
                        echo "<option value=$i ".($lastlang == $i ? "selected" : "").">$language_name[$i]</option>";
                }
                ?>
            </select >
        </div>

        <div id="editor"></div>
        <script src="ace/ace.js" type="application/javascript" charset="utf-8"></script>
        <script src="ace/mode-c_cpp.js" type="application/javascript" charset="utf-8"></script>
        <script src="ace/ext-language_tools.js"></script>
        <script>
            ace.require("ace/ext/language_tools");
            var editor = ace.editor("editor");
            editor.setOptions({
                enableBasicAutocompletion: true,
                enableSnippets: true;
                enableLiveAutocompletion: true;
            });
            editor.setTheme("ace/theme/eclipse");
            editor.getSession().setMode("ace/mode/c_cpp");
        </script>

        <script>
        var sid = 0;
        var i = 0;
        var judge_result = [
            <?php
                foreach ($judge_result as $result) {
                    echo "'$result',";
                }
            ?>''];

        function print_result(solution_id) {
            sid = solution_id;
            var xmlhttp;
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var tb = window.document.getElementById('out');
                    var r = xmlhttp.responseText;
                    tb.innerHTML = "" + r;
                }
            }
            xmlhttp.open("GET", "status-ajax.php?tr=1&solution_id=" + solution_id, true);
            xmlhttp.send();
        }

        function fresh_result(solution_id) {
            sid = solution_id;
            var xmlhttp;
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var tb = window.document.getElementById('result');
                    var r = xmlhttp.responseText;
                    var ra = r.split(",");
//     alert(r);
//     alert(judge_result[r]);
                    var loader = "<img width=18 src=image/loader.gif>";
                    var tag = "span";
                    if (ra[0] < 4) tag = "span disabled=true";
                    else tag = "a";
                    tb.innerHTML = "<" + tag + " href='reinfo.php?sid=" + solution_id + "' class='badge badge-info' target=_blank>" + judge_result[ra[0]] + "</" + tag + ">";
                    if (ra[0] < 4)tb.innerHTML += loader;
                    tb.innerHTML += "Memory:" + ra[1] + "kb&nbsp;&nbsp;";
                    tb.innerHTML += "Time:" + ra[2] + "ms";
                    if (ra[0] < 4)
                        window.setTimeout("fresh_result(" + solution_id + ")", 2000);
                    else
                        window.setTimeout("print_result(" + solution_id + ")", 2000);
                }
            }
            xmlhttp.open("GET", "status-ajax.php?solution_id=" + solution_id, true);
            xmlhttp.send();
        }
        function getSID() {
            var ofrm1 = document.getElementById("testRun").document;
            var ret = "0";
            if (ofrm1 == undefined) {
                ofrm1 = document.getElementById("testRun").contentWindow.document;
                var ff = ofrm1;
                ret = ff.innerHTML;
            }
            else {
                var ie = document.frames["frame1"].document;
                ret = ie.innerText;
            }
            return ret + "";
        }

        var count = 0;
        function do_submit() {

            if (typeof(eAL) != "undefined") {
                eAL.toggle("source");
                eAL.toggle("source");
            }


            var mark = "<?php echo isset($id) ? 'problem_id' : 'cid';?>";
            var problem_id = document.getElementById(mark);

            if (mark == 'problem_id')
                problem_id.value = '<?php echo $id?>';
            else
                problem_id.value = '<?php echo $cid?>';

            document.getElementById("frmSolution").target = "_self";
            document.getElementById("frmSolution").submit();
        }
        function do_test_run() {
            var loader = "<img width=18 src=image/loader.gif>";
            var tb = window.document.getElementById('result');
            tb.innerHTML = loader;
            if (typeof(eAL) != "undefined") {
                eAL.toggle("source");
                eAL.toggle("source");
            }


            var mark = "<?php echo isset($id) ? 'problem_id' : '';?>";
            var problem_id = document.getElementById(mark);
            problem_id.value = 0;
            document.getElementById("frmSolution").target = "testRun";
            document.getElementById("frmSolution").submit();
            document.getElementById("TestRun").disabled = true;
            document.getElementById("Submit").disabled = true;
            count = 20;
            window.setInterval("resume();", 1000);

        }

        function resume() {
            count--;
            var s = document.getElementById('Submit');
            var t = document.getElementById('TestRun');
            if (count < 0) {
                s.disabled = false;
                t.disabled = false;
                s.value = "<?php echo $MSG_SUBMIT?>";
                t.value = "<?php echo $MSG_TR?>";
                window.cleanInterval();
            } else {
                s.value = "<?php echo $MSG_SUBMIT?>(" + count + ")";
                t.value = "<?php echo $MSG_TR?>(" + count + ")";

            }
        }
        </script>

        <div id=foot>
            <?php require_once("oj-footer.php"); ?>

        </div><!--end foot-->
    </div><!--end main-->
</div><!--end wrapper-->
</body>
</html>
