<?php
    function getRecordCount($query)
    {
        $configDB = require './env/config.php';
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $result = $connessione->query($query);
        $recordCount = $result->num_rows;
        return $recordCount;
    }

    
    function pagination($count, $perpage, $href)
    {
        $configDB = require './env/config.php';
        $output = '';
        $perpage = $configDB['PER_PAGE_LIMIT'];
        $srOnly = "visually-hidden";
        if (! empty($_GET['type']) && $_GET['type'] == "prev-next-link") {
            $srOnly = "";
        }
        if (! isset($_REQUEST["pageNumber"]))
            $_REQUEST["pageNumber"] = 1;

        if ($perpage != 0)
            $pages = ceil($count / $perpage);

        // if pages exists after loop's lower limit
        if ($pages > 1) {
            if ($_REQUEST["pageNumber"] > 1) {
                $previousPage = $_REQUEST["pageNumber"] - 1;
                $output = $output . '<li class="page-item  ' . $srOnly . '"><a href="' . $href . 'pageNumber=' . $previousPage . '"class="page-link text-dark">Previous</a></li>';
            } else {
                $output = $output . '<li class="page-item  ' . $srOnly . '" disabled><a href=""class="page-link text-dark">Previous</a></li>';
            }

            if (($_REQUEST["pageNumber"] - 10) > 0) {
                $output = $output . '<li class="page-item "><a href="' . $href . 'pageNumber=1" class="page-link text-dark">1</a></li>';
            }
            if (($_REQUEST["pageNumber"] - 10) > 1) {
                $output = $output . ' <span class="mx-1">...</span> ';
            }

            // Loop for provides links for 2 pages before and after current page
            for ($i = ($_REQUEST["pageNumber"] - 10); $i <= ($_REQUEST["pageNumber"] + 10); $i ++) {
                if ($i < 1)
                    continue;
                if ($i > $pages)
                    break;
                if ($_REQUEST["pageNumber"] == $i)
                    $output = $output . '<li class="page-item active"><a class="page-link" id=' . $i . '>' . $i . '</a></li>';
                else
                    $output = $output . '<li class="page-item"><a href="' . $href . "pageNumber=" . $i . '" class="page-link text-dark">' . $i . '</a></li>';
            }

            // if pages exists after loop's upper limit
            if (($pages - ($_REQUEST["pageNumber"] + 10)) > 1) {
                $output = $output . ' <span class="mx-1">...</span> ';
            }
            if (($pages - ($_REQUEST["pageNumber"] + 10)) > 0) {
                if ($_REQUEST["pageNumber"] == $pages)
                    $output = $output . '<li class="page-item"><a id=' . ($pages) . ' class="page-link text-dark">' . ($pages) . '</a></li>';
                else
                    $output = $output . '<li class="page-item"><a href="' . $href . "pageNumber=" . ($pages) . '" class="page-link text-dark">' . ($pages) . '</a></li>';
            }

            if ($_REQUEST["pageNumber"] < $pages) {
                $nextPage = $_REQUEST["pageNumber"] + 1;
                $output = $output . '<li class="page-item   ' . $srOnly . '"><a href="' . $href . 'pageNumber=' . $nextPage . '"class="page-link text-dark">Next</a></li>';
            } else {
                $output = $output . '<li class="page-item   ' . $srOnly . '" disabled><a href=""class="page-link text-dark">Next</a></li>';
            }
        }
        return $output;
    }

    // function calculate total records count and trigger pagination function
    function showperpage($count, $per_page = "10", $href)
    {
        $perpage = pagination($count, $per_page, $href);
        return $perpage;
    }