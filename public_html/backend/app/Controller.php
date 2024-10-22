<?php

class Controller
{
  public $title;
  public $description;
  public $canonical;
  public $og_images;
  public $baseurl;
  public $phone;
  public $email;
  public $url;
  public $dir;
  public $layout;
  public $view;
  public $assets;
  public $data;
  public $_url;
  public $_dir;
  public $_layout;
  public $_view;
  public $_assets;
  public $plugins;
  public $media;
  public $media_dir;
  public $reserve_media;
  public $reserve_media_dir;
  public $files;
  public $files_dir;
  public $reserve_files;
  public $reserve_files_dir;
  public $model;
  public $mode;
  public $xFunction;
  public $lang;
  public $nocsrf;

  public function __construct($config, $db, $language, $setURI)
  {
    if (isset($config)) {
      $this->mode = $config['CONFIG_MODE'];
      $this->phone = $config['BASE_WEB_PHONE'];
      $this->email = $config['BASE_WEB_EMAIL'];
      $this->url = $config['BASE_FRONT_URL'];
      $this->dir = $config['BASE_FRONT_DIR'];
      $this->layout = $this->dir . $config['BASE_FRONT_LAYOUT'];
      $this->view = $this->dir . $config['BASE_FRONT_VIEW'];
      $this->assets = $config['BASE_FRONT_ASSETS'];
      $this->_url = $config['BASE_BACK_URL'];
      $this->_dir = $config['BASE_BACK_DIR'];
      $this->_layout = $this->_dir . $config['BASE_BACK_LAYOUT'];
      $this->_view = $this->_dir . $config['BASE_BACK_VIEW'];
      $this->_assets = $config['BASE_BACK_ASSETS'];
      $this->plugins = $config['PLUGINS'];
      $this->media = $config['MEDIA'];
      $this->media_dir = $this->dir . $config['BASE_MEDIA'];
      $this->files = $config['FILES'];
      $this->files_dir = $this->dir . $config['BASE_FILES'];
      $this->reserve_media = $config['RESERVE_MEDIA'];
      $this->reserve_media_dir = $this->dir . $config['BASE_RESERVE_MEDIA'];
      $this->reserve_files = $config['RESERVE_FILES'];
      $this->reserve_files_dir = $this->dir . $config['BASE_RESERVE_FILES'];
    }
    if (isset($language)) {
      $this->lang = json_decode(json_encode($language[$config['BASE_LANG']]));
    }
    if (isset($setURI)) {
      $this->baseurl = json_decode(json_encode($setURI));
    }
    if (isset($db)) {
      $this->model = new Model($db);
    }
    $this->xFunction = new xFunction($this->lang, $this->mode);
    $this->nocsrf = new NoCSRF();
  }
  public function headINC()
  {
    include_once($this->layout . 'head.php');
    include_once($this->layout . 'header.php');
  }
  public function contentINC()
  {
    $slideList = $this->model->getDataList(array("table" => "banner_tbl", "field" => "banner_id as id,banner_img_path as pc_slider,banner_moblie_img_path as mb_slider,banner_title as title,banner_description as description,banner_order as sort_order", "where" => " banner_status='1' ", "sort_by" => "banner_order DESC"));
    $stickyList = $this->model->getDataList(array("table" => "news_tbl a LEFT JOIN category_tbl b ON a.category_id=b.category_id ", "field" => "a.news_id as id,a.category_id,a.news_title as title,a.news_overview as overview,a.news_img_thumbnail_path as thumbnail,a.news_datetime_start as news_date,b.category_name", "where" => " a.news_status='1' AND a.news_sticky='1' AND a.category_id!='1' AND a.news_datetime_start<=NOW() AND a.news_datetime_end>=NOW() ", "sort_by" => "a.news_datetime_start DESC"));
    $featuredList = $this->model->getDataList(array("table" => "news_tbl a LEFT JOIN category_tbl b ON a.category_id=b.category_id ", "field" => "a.news_id as id,a.category_id,a.news_title as title,a.news_overview as overview,a.news_img_thumbnail_path as thumbnail,a.news_datetime_start as news_date,b.category_name", "where" => " a.news_status='1' AND a.news_sticky!='1' AND a.category_id!='1' AND a.news_visit>='50' AND a.news_datetime_start<=NOW() AND a.news_datetime_end>=NOW() ", "sort_by" => "a.news_visit DESC", "limit" => "0,6"));
    $includedList = $this->model->getDataList(array("table" => "news_tbl a LEFT JOIN category_tbl b ON a.category_id=b.category_id ", "field" => "a.news_id as id,a.category_id,a.news_title as title,a.news_overview as overview,a.news_img_thumbnail_path as thumbnail,a.news_datetime_start as news_date,b.category_name", "where" => " a.news_status='1' AND a.news_sticky!='1' AND a.category_id!='1' AND a.news_visit<'50' AND a.news_datetime_start<=NOW() AND a.news_datetime_end>=NOW() AND a.news_datetime_start>= DATE(NOW()) - INTERVAL 7 DAY ", "sort_by" => "a.news_datetime_start DESC"));
    $activityList = $this->model->getDataList(array("table" => "news_tbl a LEFT JOIN category_tbl b ON a.category_id=b.category_id ", "field" => "a.news_id as id,a.category_id,a.news_title as title,a.news_overview as overview,a.news_img_thumbnail_path as thumbnail,a.news_datetime_start as news_date,a.news_visit as visit,b.category_name", "where" => " a.news_status='1' AND a.category_id='1' AND a.news_visit<'50' AND a.news_datetime_start<=NOW() AND a.news_datetime_end>=NOW() ", "sort_by" => "a.news_datetime_start DESC", "limit" => "0,6"));
    include_once($this->layout . 'main.php');
  }
  public function footerINC()
  {
    include_once($this->layout . 'footer.php');
  }
  public function footerendINC()
  {
    include_once($this->layout . 'footer_end.php');
  }
  public function page404()
  {
    include_once($this->layout . 'head.php');
    include_once($this->layout . '404.php');
    include_once($this->layout . 'footer_end.php');
  }
  public function HOMEPAGE()
  {
    $this->title = $this->lang->meta_title;
    $this->description = $this->lang->meta_description;
    $this->headINC();
    $this->contentINC();
    $this->footerINC();
    $this->footerendINC();
  }
  public function sharingDATA()
  {
    $data = '';
    $data = array();
    $depList = $this->model->getDataList(array("table" => "department_tbl", "field" => "department_id as id,department_name as name", "sort_by" => "department_name ASC"));
    if (is_array($depList)) {
      foreach ($depList as $department) {
        $data['department'][$department['id']] = $department['name'];
      }
    }
    $categoryList = $this->model->getDataList(array("table" => "category_tbl", "field" => "category_id as id,category_name as name", "sort_by" => "category_name ASC"));
    if (is_array($categoryList)) {
      foreach ($categoryList as $category) {
        $data['newstype'][$category['id']] = $category['name'];
      }
    }
    $setting = $this->model->getData(array("table" => "web_config", "field" => "*", "where" => " id='1'"));
    if (is_array($setting) && !empty($setting['id'])) {
      $data['web_config']['breadcrumbs'] = $setting['breadcrumbs'];
    }
    return $data;
  }
  public function output()
  {
    $this->data = $this->sharingDATA();
    if (isset($_GET['select']) && !empty($_GET['select'])) {
      switch ($_GET['select']) {
        case "news":
          $this->deptNEW();
          break;
        case "search":
          $this->deptSEARCH();
          break;
        default:
          $this->page404();
      }
    } else {
      $this->HOMEPAGE();
    }
  }
  public function deptNEW()
  {
    if (isset($_GET['m']) && !empty($_GET['m']) && isset($_GET['id']) && !empty($_GET['id'])) {
      $error = '';
      $newURL = '';
      $var_mode = $_GET['m'];
      $var_id = $_GET['id'];
      if ($var_mode == 'detail') {
        $nb_visit = '';
        $check_visit = $this->model->getData(array("table" => "news_tbl", "field" => "news_id as id,news_visit as visit", "where" => " news_id='" . $var_id . "' AND news_status='1' "));
        if (is_array($check_visit) && !empty($check_visit['id'])) {
          $nb_visit = $check_visit['visit'] + 1;
        } else {
          $nb_visit = 1;
        }
        if (!empty($nb_visit)) {
          $this->model->updateData(array("table" => "news_tbl", "field" => array("news_visit" => $nb_visit), "where" => " news_id='" . $var_id . "' "));
        }
        $getNEWS = $this->model->getData(array("table" => "news_tbl a LEFT JOIN category_tbl b ON a.category_id=b.category_id LEFT JOIN department_news_tbl c ON a.news_id=c.news_id LEFT JOIN account_tbl d ON a.user_id=d.account_id ", "field" => "a.news_id as id,a.category_id,a.news_title as title,a.news_overview as overview,a.news_description as description,a.news_img_thumbnail_path as thumbnail,a.news_datetime_start as news_date,a.news_visit as visit,a.news_youtube as youtube,b.category_name,a.department_list,d.fullname", "where" => " a.news_id='" . $var_id . "' AND a.news_status='1' "));
        if (is_array($getNEWS) && !empty($getNEWS['id'])) {
          $newURL = $this->baseurl->front->module->news->detail . $getNEWS['id'];
          $count_visit = '';
          if ($getNEWS['visit'] > 0) {
            $count_visit = '<span><i class="fa fa-eye"></i> ' . number_format($getNEWS['visit']) . ' ' . $this->lang->label->nbcount . '</span>';
          } else {
            $count_visit = '';
          }
          $typeList = $this->model->getDataList(array("table" => "news_tbl a LEFT JOIN category_tbl b ON a.category_id=b.category_id", "field" => "a.category_id as id,b.category_name as name,COUNT(a.category_id) as total ", "group_by" => "a.category_id"));
          $pageINC = '';
          $filesList = $this->model->getDataList(array("table" => "news_files_tbl", "field" => "news_files_id as id,news_files_title as title,news_files_path as files_src", "where" => " news_id='" . $var_id . "'", "sort_by" => "news_files_id ASC "));
          $galleryList = $this->model->getDataList(array("table" => "gallery_tbl", "field" => "gallery_id as id,gallery_title as title,gallery_path as img_src", "where" => " news_id='" . $var_id . "'", "sort_by" => "gallery_id ASC "));
          $newsLasted = $this->model->getDataList(array("table" => "news_tbl", "field" => "news_id as id,news_title as title,news_datetime_start as news_date", "where" => " news_id!='" . $var_id . "' AND news_status='1' AND news_datetime_start<=NOW() AND news_datetime_end>=NOW() ", "sort_by" => " news_datetime_start DESC", "limit" => '0,6'));
          $depCOUNT = $this->model->getData(array("table" => "department_news_tbl", "field" => "COUNT(department_news_id) as total", "where" => " news_id='" . $var_id . "'"));
          if (is_array($depCOUNT) && !empty($depCOUNT['total'])) {
            if ($depCOUNT['total'] == 1) {
              $GETdep = $this->model->getData(array("table" => "department_tbl", "field" => "department_id as id,department_name as name", "where" => " department_id='" . $getNEWS['department_list'] . "'"));
              if (is_array($GETdep) && !empty($GETdep['id'])) {
                $department_name = $this->xFunction->htmlspec($GETdep['name']);
              } else {
                $department_name = '';
              } //getDEP
            } //check count
          } //count DEP
          /*Meta TAG*/
          $this->title = $this->xFunction->htmlspec($getNEWS['title']);
          $this->description = $this->xFunction->htmlspec($getNEWS['overview']);
          $this->canonical = $this->baseurl->front->module->news->detail . $getNEWS['id'];
          if (!empty($getNEWS['thumbnail'])) {
            $this->og_images = $this->mediaURL('news_thumbnail') . $getNEWS['thumbnail'];
          }
          /*Meta TAG*/
          $pageINC = $this->view . '/news/detail.php';
          $this->headINC();
          include_once($pageINC);
          $this->footerINC();
          $this->footerendINC();
          $error = 0;
        } else {
          $error = 1;
        }
      } else {
        $error = 1;
      }
      if ($error == 1) {
        $this->page404();
      }
    } else {
      $var_keywords = '';
      $where = '';
      $error = '';
      $h2_title = $this->lang->front->newslist;
      /*Meta TAG*/
      $this->title = $this->lang->front->newslist . ' | ' . $this->lang->meta_title;
      $this->description = $this->lang->front->newslist . ',' . $this->lang->meta_description;
      /*Meta TAG*/
      $link_url = '';
      $link_url = $this->baseurl->front->module->news->list;
      $where .= " a.news_status='1' AND a.news_datetime_start<=NOW() AND a.news_datetime_end>=NOW() ";
      if (isset($_REQUEST['d']) && !empty($_REQUEST['d'])) {
        $var_d = $_REQUEST['d'];
        $department = $this->model->getData(array("table" => "department_tbl", "field" => "department_id as id,department_name as name", "where" => " department_id='" . $var_d . "'"));
        if (is_array($department) && !empty($department['id'])) {
          $h2_title = $this->xFunction->htmlspec($department['name']);
          $where .= " AND b.department_id='" . $var_d . "'";
          $link_url .= '&d=' . $var_d;
          /*Meta TAG*/
          $this->title = $this->xFunction->htmlspec($department['name']) . ' | ' . $this->lang->meta_title;
          $this->description = $this->xFunction->htmlspec($department['name']) . ',' . $this->lang->meta_description;
          /*Meta TAG*/
        } else {
          $error = 1;
        }
      }
      if (isset($_REQUEST['c']) && !empty($_REQUEST['c'])) {
        $var_c = $_REQUEST['c'];
        $category = $this->model->getData(array("table" => "category_tbl", "field" => "category_id as id,category_name as name", "where" => " category_id='" . $var_c . "'"));
        if (is_array($category) && !empty($category['id'])) {
          $h2_title = $this->xFunction->htmlspec($category['name']);
          $where .= " AND a.category_id='" . $var_c . "'";
          $link_url .= '&c=' . $var_c;
          /*Meta TAG*/
          $this->title = $this->xFunction->htmlspec($category['name']) . ' | ' . $this->lang->meta_title;
          $this->description = $this->xFunction->htmlspec($category['name']) . ',' . $this->lang->meta_description;
          /*Meta TAG*/
        } else {
          $error = 1;
        }
      }
      if (isset($_REQUEST['sdate']) && !empty($_REQUEST['sdate'])) {
        $search_date = explode(' - ', $_REQUEST['sdate']);
        $startDate = $this->xFunction->datetimeDB($search_date[0]);
        $endDate = $this->xFunction->datetimeDB($search_date[1]);
        if ($startDate == $endDate) {
          $where .= " AND DATE(a.news_datetime_start)='" . $startDate . "'";
        } else if ($startDate < $endDate) {
          $where .= " AND (DATE(a.news_datetime_start) BETWEEN '" . $startDate . "' AND '" . $endDate . "')";
        } else {
          $where .= "";
        }
        $link_url .= '&sdate=' . $this->xFunction->url_space($_REQUEST['sdate']);
      } //search_date
      $pageINC = '';
      $pageINC = $this->view . '/news/news.php';
      if (file_exists($pageINC) && empty($error)) {
        $this->headINC();
        $per_page = 12;
        if (!isset($_REQUEST['page']) || empty($_REQUEST['page'])) {
          $check_page = 1;
          $current_page = 1;
          $_REQUEST['page'] = 0;
        } else {
          $check_page = $_REQUEST['page'];
          $current_page = $check_page;
          $_REQUEST['page'] = ($_REQUEST['page'] - 1) * $per_page;
        }
        $title_search = '';
        $var_keywords = 'q=';
        $find_field = 'a.news_title';
        $case_search = '';
        $sort_search = '';
        $reset_search = '';
        if (!isset($_REQUEST['q']) || empty($_REQUEST['q'])) {
          $sort_search = "GROUP BY a.news_id ORDER BY a.news_datetime_start DESC";
          $search_nav = $link_url . '&';
          $search_page = $link_url . '&page=';
          $title_search = '';
          $reset_search = '';
        } else {
          $search_keywords = $this->xFunction->htmlspec($_REQUEST['q'], 1);
          $keywords = preg_replace('/\\\\/', '', $search_keywords);
          $case_search .= " AND locate('" . $keywords . "', $find_field) > 0  ";
          $sort_search = " GROUP BY a.news_id ORDER BY a.news_datetime_start DESC,locate('" . $keywords . "', $find_field), $find_field ";
          $keywords_page = '&' . $var_keywords . $this->xFunction->url_space($_REQUEST['q']);
          $search_nav = $link_url . $keywords_page . '&';
          $search_page = $link_url . $keywords_page . '&page=';
          $title_search = $this->lang->action->search . ' : <b>' . $_REQUEST['q'] . '</b>';
          $reset_search = '<a href="' . $link_url . '" class="btn-box-reset"><i class="fa fa-undo"></i> ' . $this->lang->action->reseted . '</a>';
        }

        $items = $this->model->getDataList(array("table" => "news_tbl a LEFT JOIN department_news_tbl b ON a.news_id=b.news_id LEFT JOIN category_tbl c ON a.category_id=c.category_id ", "field" => "b.department_id,a.news_id as id,a.category_id,a.news_title as title,a.news_overview as overview,a.news_img_thumbnail_path as thumbnail,a.news_datetime_start as news_date,c.category_name", "where" => " " . $where . $case_search . $sort_search));

        $total_items = count($items);
        $page_limit = $_REQUEST['page'] . "," . $per_page;

        $newsList = $this->model->getDataList(array("table" => "news_tbl a LEFT JOIN department_news_tbl b ON a.news_id=b.news_id LEFT JOIN category_tbl c ON a.category_id=c.category_id", "field" => "b.department_id,a.news_id as id,a.category_id,a.news_title as title,a.news_overview as overview,a.news_img_thumbnail_path as thumbnail,a.news_datetime_start as news_date,c.category_name", "where" => " " . $where . $case_search . $sort_search, "limit" => $page_limit));

        $total_items_limit = count($newsList);
        if ($total_items_limit >= 1) {
          $plus_p = ($check_page * $per_page) + $total_items_limit;
        } else {
          $plus_p = ($check_page * $per_page);
        }
        $total_p = ceil($total_items / $per_page);
        $before_p = ($check_page * $per_page) + 1;

        $click_prev = '';
        $click_next = '';
        $nb_prev = '';
        $nb_next = '';
        if ((empty($total_p) || $total_p == 1) && $current_page == 1) {
          $click_prev = $this->xFunction->nav_arrow('left', 'disabled');
          $click_next = $this->xFunction->nav_arrow('right', 'disabled');
        } else if ($total_p > 1 && $current_page > 1 && $total_p == $current_page) {
          $nb_prev = $current_page - 1;
          $click_prev = $this->xFunction->nav_arrow('left', 'on', $search_page . $nb_prev);
          $click_next = $this->xFunction->nav_arrow('right', 'disabled');
        } else if ($total_p >= 1 && $current_page >= 1 && $total_p > $current_page) {
          $nb_prev = $current_page - 1;
          $nb_next = $current_page + 1;
          if ($current_page == 1) {
            $click_prev = $this->xFunction->nav_arrow('left', 'disabled');
            $click_next = $this->xFunction->nav_arrow('right', 'on', $search_page . $nb_next);
          } else {
            $click_prev = $this->xFunction->nav_arrow('left', 'on', $search_page . $nb_prev);
            $click_next = $this->xFunction->nav_arrow('right', 'on', $search_page . $nb_next);
          }
        }
        include_once($pageINC);
        $this->footerINC();
        $this->footerendINC();
        $error = 0;
      } else {
        $error = 1;
      }
      if ($error == 1) {
        $this->page404();
      }
    } //check mode
  } //deptNEW
  public function deptSEARCH()
  {
    $var_keywords = '';
    $where = '';
    $error = '';
    $h2_title = $this->lang->front->newslist;
    /*Meta TAG*/
    $this->title = 'ค้นหาข่าว | ' . $this->lang->meta_title;
    $this->description = 'ค้นหาข่าวย้อนหลัง, ค้นหาข่าว, ข่าวย้อนหลัง,' . $this->lang->meta_description;
    /*Meta TAG*/
    $link_url = '';
    $link_url = $this->baseurl->front->module->search->list;
    $where .= " a.news_status='1' AND a.news_datetime_end<NOW()";
    if (isset($_REQUEST['sdate']) && !empty($_REQUEST['sdate'])) {
      $search_date = explode(' - ', $_REQUEST['sdate']);
      $startDate = $this->xFunction->datetimeDB($search_date[0]);
      $endDate = $this->xFunction->datetimeDB($search_date[1]);
      if ($startDate == $endDate) {
        $where .= " AND DATE(a.news_datetime_start)='" . $startDate . "'";
      } else if ($startDate < $endDate) {
        $where .= " AND (DATE(a.news_datetime_start) BETWEEN '" . $startDate . "' AND '" . $endDate . "')";
      } else {
        $where .= "";
      }
      $link_url .= '&sdate=' . $this->xFunction->url_space($_REQUEST['sdate']);
    } //search_date
    $pageINC = '';
    $pageINC = $this->view . '/news/search.php';
    if (file_exists($pageINC)) {
      $this->headINC();
      $per_page = 12;
      if (!isset($_REQUEST['page']) || empty($_REQUEST['page'])) {
        $check_page = 1;
        $current_page = 1;
        $_REQUEST['page'] = 0;
      } else {
        $check_page = $_REQUEST['page'];
        $current_page = $check_page;
        $_REQUEST['page'] = ($_REQUEST['page'] - 1) * $per_page;
      }
      $title_search = '';
      $var_keywords = 'q=';
      $find_field = 'a.news_title';
      $case_search = '';
      $sort_search = '';
      $reset_search = '';
      if (!isset($_REQUEST['q']) || empty($_REQUEST['q'])) {
        $sort_search = "GROUP BY a.news_id ORDER BY a.news_datetime_start DESC";
        $search_nav = $link_url . '&';
        $search_page = $link_url . '&page=';
        $title_search = '';
        $reset_search = '';
      } else {
        $search_keywords = $this->xFunction->htmlspec($_REQUEST['q'], 1);
        $keywords = preg_replace('/\\\\/', '', $search_keywords);
        $case_search .= " AND locate('" . $keywords . "', $find_field) > 0  ";
        $sort_search = " GROUP BY a.news_id ORDER BY a.news_datetime_start DESC,locate('" . $keywords . "', $find_field), $find_field";
        $keywords_page = '&' . $var_keywords . $this->xFunction->url_space($_REQUEST['q']);
        $search_nav = $link_url . $keywords_page . '&';
        $search_page = $link_url . $keywords_page . '&page=';
        $title_search = $this->lang->action->search . ' : <b>' . $_REQUEST['q'] . '</b>';
        $reset_search = '<a href="' . $link_url . '" class="btn-box-reset"><i class="fa fa-undo"></i> ' . $this->lang->action->reseted . '</a>';
      }

      $items = $this->model->getDataList(array("table" => "news_tbl a LEFT JOIN department_news_tbl b ON a.news_id=b.news_id LEFT JOIN category_tbl c ON a.category_id=c.category_id ", "field" => "b.department_id,a.news_id as id,a.category_id,a.news_title as title,a.news_overview as overview,a.news_img_thumbnail_path as thumbnail,a.news_datetime_start as news_date,c.category_name", "where" => " " . $where . $case_search . $sort_search));

      $total_items = count($items);
      $page_limit = $_REQUEST['page'] . "," . $per_page;

      $newsList = $this->model->getDataList(array("table" => "news_tbl a LEFT JOIN department_news_tbl b ON a.news_id=b.news_id LEFT JOIN category_tbl c ON a.category_id=c.category_id", "field" => "b.department_id,a.news_id as id,a.category_id,a.news_title as title,a.news_overview as overview,a.news_img_thumbnail_path as thumbnail,a.news_datetime_start as news_date,c.category_name", "where" => " " . $where . $case_search . $sort_search, "limit" => $page_limit));

      $total_items_limit = count($newsList);
      if ($total_items_limit >= 1) {
        $plus_p = ($check_page * $per_page) + $total_items_limit;
      } else {
        $plus_p = ($check_page * $per_page);
      }
      $total_p = ceil($total_items / $per_page);
      $before_p = ($check_page * $per_page) + 1;

      $click_prev = '';
      $click_next = '';
      $nb_prev = '';
      $nb_next = '';
      if ((empty($total_p) || $total_p == 1) && $current_page == 1) {
        $click_prev = $this->xFunction->nav_arrow('left', 'disabled');
        $click_next = $this->xFunction->nav_arrow('right', 'disabled');
      } else if ($total_p > 1 && $current_page > 1 && $total_p == $current_page) {
        $nb_prev = $current_page - 1;
        $click_prev = $this->xFunction->nav_arrow('left', 'on', $search_page . $nb_prev);
        $click_next = $this->xFunction->nav_arrow('right', 'disabled');
      } else if ($total_p >= 1 && $current_page >= 1 && $total_p > $current_page) {
        $nb_prev = $current_page - 1;
        $nb_next = $current_page + 1;
        if ($current_page == 1) {
          $click_prev = $this->xFunction->nav_arrow('left', 'disabled');
          $click_next = $this->xFunction->nav_arrow('right', 'on', $search_page . $nb_next);
        } else {
          $click_prev = $this->xFunction->nav_arrow('left', 'on', $search_page . $nb_prev);
          $click_next = $this->xFunction->nav_arrow('right', 'on', $search_page . $nb_next);
        }
      }
      include_once($pageINC);
      $this->footerINC();
      $this->footerendINC();
    } else {
      $this->page404();
    }
  } //deptSEARCH
  public function _headINC()
  {
    include_once($this->_layout . 'head.php');
    include_once($this->_layout . 'header.php');
    include_once($this->_layout . 'sidebar.php');
  }
  public function _contentINC()
  {
    include_once($this->_layout . 'dashboard.php');
  }
  public function _footerINC()
  {
    include_once($this->_layout . 'footer.php');
  }
  public function _page404()
  {
    include_once($this->_layout . '404.php');
  }
  public function BACKEND()
  {
    $this->Authentication();
    $this->_headINC();
    $this->_contentINC();
    $this->_footerINC();
  }
  public function _output()
  {
    if (isset($_GET['select']) && !empty($_GET['select'])) {
      if ($this->checkUID('level') == 9 || $this->checkUID('level') == 8) {
        switch ($_GET['select']) {
          case "dashboard":
            $this->BACKEND();
            break;
          case "moderator":
            $this->moduleMODERATOR();
            break;
          case "print":
            $this->modulePRINT();
            break;
          case "account":
            $this->moduleACCOUNT();
            break;
          case "slide":
            $this->moduleSLIDE();
            break;
          case "news":
            $this->moduleNEWS();
            break;
          case "Authorization":
            $this->moduleAUTH();
            break;
          case "Process":
            $this->_processing();
            break;
          case "Loading":
            $this->_dataloading();
            break;
          case "user":
            $this->moduleUSER();
            break;
          default:
            $this->_page404();
        }
      } else {
        switch ($_GET['select']) {
          case "dashboard":
            $this->BACKEND();
            break;
          case "news":
            $this->moduleNEWS();
            break;
          case "Authorization":
            $this->moduleAUTH();
            break;
          case "Process":
            $this->_processing();
            break;
          case "Loading":
            $this->_dataloading();
            break;
          case "user":
            $this->moduleUSER();
            break;
          default:
            $this->_page404();
        }
      } //check user level
    } else {
      $this->_page404();
    }
  }
  public function _dataloading()
  {
    $this->Authentication();
    if (isset($_POST['module']) && !empty($_POST['module'])) {
      switch ($_POST['module']) {
        case "News":
          $this->loadNEWS();
          break;
        case "Moderator":
          $this->loadMODERATOR();
          break;
        default:
          $this->_page404();
      }
    } else {
      $this->_page404();
    }
  }
  public function _processing()
  {
    $this->Authentication();
    if (isset($_POST['module']) && !empty($_POST['module'])) {
      if ($this->checkUID('level') == 9 || $this->checkUID('level') == 8) {
        switch ($_POST['module']) {
          case "Account":
            $this->formACCOUNT();
            break;
          case "Moderator":
            $this->formMODERATOR();
            break;
          case "Slide":
            $this->formSLIDE();
            break;
          case "News":
            $this->formNEWS();
            break;
          default:
            $this->_page404();
        }
      } else {
        switch ($_POST['module']) {
          case "News":
            $this->formNEWS();
            break;
          default:
            $this->_page404();
        }
      } //check user level
    } else {
      $this->_page404();
    }
  }
  public function mediaFolder($data)
  {
    if (isset($data) && !empty($data)) {
      switch ($data) {
        case "banner":
          return $this->media_dir . 'banner/';
          break;
        case "breadcrumbs":
          return $this->media_dir . 'breadcrumbs/';
          break;
        case "gallery":
          return $this->media_dir . 'gallery/';
          break;
        case "gallery_original":
          return $this->media_dir . 'gallery/original/';
          break;
        case "news_thumbnail":
          return $this->media_dir . 'news/thumbnail/';
          break;
        case "news":
          return $this->media_dir . 'news/';
          break;
        case "news_original":
          return $this->media_dir . 'news/original/';
          break;
        default:
          '';
      }
    }
  }
  public function mediaURL($data)
  {
    if (isset($data) && !empty($data)) {
      switch ($data) {
        case "banner":
          return $this->media . 'banner/';
          break;
        case "breadcrumbs":
          return $this->media . 'breadcrumbs/';
          break;
        case "gallery":
          return $this->media . 'gallery/';
          break;
        case "gallery_original":
          return $this->media . 'gallery/original/';
          break;
        case "news_thumbnail":
          return $this->media . 'news/thumbnail/';
          break;
        case "news":
          return $this->media . 'news/';
          break;
        case "news_original":
          return $this->media . 'news/original/';
          break;
        default:
          '';
      }
    }
  }
  public function ReserveMediaFolder($data)
  {
    if (isset($data) && !empty($data)) {
      switch ($data) {
        case "gallery":
          return $this->reserve_media_dir . 'gallery/';
          break;
        case "gallery_original":
          return $this->reserve_media_dir . 'gallery/original/';
          break;
        case "news_thumbnail":
          return $this->reserve_media_dir . 'news/thumbnail/';
          break;
        default:
          '';
      }
    }
  }
  public function ReserveMediaURL($data)
  {
    if (isset($data) && !empty($data)) {
      switch ($data) {
        case "gallery":
          return $this->reserve_media . 'gallery/';
          break;
        case "gallery_original":
          return $this->reserve_media . 'gallery/original/';
          break;
        case "news_thumbnail":
          return $this->reserve_media . 'news/thumbnail/';
          break;
        default:
          '';
      }
    }
  }
  public function filesFolder($data)
  {
    if (isset($data) && !empty($data)) {
      switch ($data) {
        case "news":
          return $this->files_dir . 'news/';
          break;
        default:
          '';
      }
    }
  }
  public function filesURL($data)
  {
    if (isset($data) && !empty($data)) {
      switch ($data) {
        case "news":
          return $this->files . 'news/';
          break;
        default:
          '';
      }
    }
  }
  public function ReserveFilesFolder($data)
  {
    if (isset($data) && !empty($data)) {
      switch ($data) {
        case "news":
          return $this->reserve_files_dir . 'news/';
          break;
        default:
          '';
      }
    }
  }
  public function ReserveFilesURL($data)
  {
    if (isset($data) && !empty($data)) {
      switch ($data) {
        case "news":
          return $this->reserve_files . 'news/';
          break;
        default:
          '';
      }
    }
  }
  public function checkUID($data = '')
  {
    if (isset($_SESSION)) {
      if (!empty($_SESSION['ss_userid']) && !empty($_SESSION['ss_usercode']) && !empty($_SESSION['ss_userauth'])) {
        if ($data == 'id') {
          return $_SESSION['ss_usercode'];
        } else if ($data == 'level') {
          return $_SESSION['ss_userauth'];
        } else if ($data == 'sid') {
          return $_SESSION['ss_userid'];
        } else {
          return true;
        }
      } else {
        return false;
      } //empty
    } //isset
  }
  public function Authentication()
  {
    if ($this->checkUID() === true) {
      $myaccount = $this->model->getData(array("table" => "account_tbl", "field" => "account_id as id,username,email,account_level as level", "where" => " account_id='" . $this->checkUID('id') . "' AND account_status='1' "));
      if (is_array($myaccount) && !empty($myaccount['id'])) {
        $data['id'] = $myaccount['id'];
        $data['username'] = $myaccount['username'];
        $data['email'] = $myaccount['email'];
        $data['level'] = $myaccount['level'];
        $this->profile = json_decode(json_encode($data));
      } else {
        $this->xFunction->xRedirect($this->baseurl->backend->module->user->logout);
      }
    } else {
      $this->xFunction->xRedirect($this->baseurl->backend->module->user->login);
    }
  } //Authentication
  public function filesUSER($service)
  {
    if (isset($service) && !empty($service)) {
      switch ($service) {
        case "login":
          return $this->_view . 'user/login.php';
          break;
        case "logout":
          return $this->_view . 'user/logout.php';
          break;
        case "setPassword":
          return $this->_view . 'user/pw.php';
          break;
        default:
          null;
      }
    }
  }
  public function moduleUSER()
  {
    if ($this->filesUSER($_GET['service']) != null) {
      if (file_exists($this->filesUSER($_GET['service']))) {
        if (($_GET['service'] == 'login' || $_GET['service'] == 'setPassword') && $this->checkUID() === true) {
          $this->xFunction->jsRedirect($this->baseurl->dashboard);
        } //login
        if ($_GET['service'] == 'setPassword') {
          $var_uid = $_GET['uid'];
          $var_identify = $_GET['identify'];
          $check_user = $this->model->getData(array("table" => "account_tbl", "field" => "account_id as id,username", "where" => " account_id='" . $var_uid . "' AND password='" . $var_identify . "' AND reset_password='1' "));
          if (is_array($check_user) && !empty($check_user['id'])) {
            $getUsername = $check_user['username'];
          } else {
            $this->xFunction->jsRedirect($this->baseurl->backend->module->user->login);
          }
        } //setPassword
        include_once($this->filesUSER($_GET['service']));
      }
    } else {
      $this->_page404();
    }
  }
  public function formAUTH()
  {

    if (isset($_POST['action']) && !empty($_POST['action'])) {
      if ($_POST['action'] == 'check-login') {
        $var_username = $_POST['username'];
        $var_password = md5($_POST['password']);
        $error = '';
        $check = $this->model->getData(array("table" => "account_tbl", "field" => "account_id as id,account_level", "where" => " username='" . $var_username . "' AND password='" . $var_password . "' AND account_status='1' "));
        if (is_array($check) && !empty($check['id'])) {
          $_SESSION['ss_userid'] = session_id();
          $_SESSION['ss_usercode'] = $check['id'];
          $_SESSION['ss_userauth'] = $check['account_level'];

          $this->model->insertData(array("table" => "website_log", "field" => array("user_id" => $check['id'], "create_at" => date("Y-m-d H:i:s"))));

          $this->xFunction->jsRedirect($this->baseurl->dashboard);
        } else {
          $error = true;
        }
        if ($error === true) {
          $this->xFunction->pageReload($this->lang->alert->incorrect->login_fail);
        }
      } //action = check-login
      if ($_POST['action'] == 'change-password') {
        $var_id = $_POST['id'];
        $var_password = md5($_POST['password']);
        $var_identify = $_POST['identify'];
        $error = '';
        $check = $this->model->getData(array("table" => "account_tbl", "field" => "account_id as id", "where" => " account_id='" . $var_id . "' AND password='" . $var_identify . "' AND reset_password='1' AND account_status='1' "));
        if (is_array($check) && !empty($check['id'])) {
          $update = $this->model->updateData(array("table" => "account_tbl", "field" => array("password" => $var_password, "reset_password" => '0'), "where" => " account_id='" . $check['id'] . "' "));
          if ($update === true) {
            $this->xFunction->pageReload($this->lang->alert->success->resetPassword, $this->baseurl->backend->module->user->login);
          } else {
            $error = true;
          }
        } else {
          $error = true;
        }
        if ($error === true) {
          $this->xFunction->pageReload($this->lang->alert->fail->resetPassword);
        }
      } //action = change-password
      $this->xFunction->resetToken($this->nocsrf->generate('csrf_token')); //load new token
    } //check isset
  }
  public function moduleAUTH()
  {
    try {
      $this->nocsrf->check('csrf_token', $_POST, true, 60 * 30, false); // for 30 minutes, in one-time mode.
      if (isset($_POST['module']) && isset($_POST['action'])) {
        switch ($_POST['module']) {
          case "Service":
            $this->formAUTH();
            break;
          default:
            $this->xFunction->pageReload($this->lang->alert->fail->proceed);;
        }
      } else {
        $this->xFunction->pageReload($this->lang->alert->fail->proceed);
      }
    } catch (Exception $e) {
      $this->xFunction->pageReload($this->lang->alert->token->expired);
    } //CSRF Token
  }
  /*moderator*/
  public function filesPRINT($tab)
  {
    if (isset($tab) && !empty($tab)) {
      switch ($tab) {
        case "report":
          return $this->_view . 'print/report.php';
          break;
        default:
          null;
      }
    }
  }
  public function modulePRINT()
  {
    $this->Authentication();
    if ($this->filesPRINT($_GET['tab']) != null) {
      if (file_exists($this->filesPRINT($_GET['tab']))) {
        if ($_GET['tab'] == 'report') {
          $where = '';
          if (!empty($_GET['sdate']) && !empty($_GET['department'])) {
            $exp_date =  explode(' - ', $_REQUEST['sdate']);
            $start = $exp_date[0];
            $end = $exp_date[1];
            $startDate = $this->xFunction->datetimeDB($exp_date[0]);
            $endDate = $this->xFunction->datetimeDB($exp_date[1]);
            $where .= "c.department_id='" . $_REQUEST['department'] . "'";
            $where .= " AND ( DATE(a.create_at) BETWEEN '" . $startDate . "' AND '" . $endDate . "'  )";
            $reportList = $this->model->getDataList(array("table" => "news_tbl a LEFT JOIN account_tbl b ON a.user_id=b.account_id LEFT JOIN department_news_tbl c ON a.news_id=c.news_id", "field" => "a.news_id as id,a.news_title as title,a.create_at,a.news_datetime_start as news_start,a.news_datetime_end as news_end,b.account_id,b.fullname", "where" => $where, "sort_by" => "a.news_id DESC"));
            $getData = $this->model->getData(array("table" => "department_tbl", "field" => "*", "where" => " department_id='" . $_REQUEST['department'] . "' "));
            $total = 0;
            if (is_array($reportList)) {
              foreach ($reportList as $value) {
                $total += 1;
              }
            }
          }
        } //report
        include_once($this->filesPRINT($_GET['tab']));
      }
    }
  }
  /*moderator*/
  public function filesMODERATOR($tab)
  {
    if (isset($tab) && !empty($tab)) {
      switch ($tab) {
        case "setting":
          return $this->_view . 'moderator/setting.php';
          break;
        case "newstype":
          return $this->_view . 'moderator/newstype.php';
          break;
        case "department":
          return $this->_view . 'moderator/department.php';
          break;
        case "news":
          return $this->_view . 'moderator/news.php';
          break;
        case "images":
          return $this->_view . 'moderator/images.php';
          break;
        case "log":
          return $this->_view . 'moderator/log.php';
          break;
        case "report":
          return $this->_view . 'moderator/report.php';
          break;
        default:
          null;
      }
    }
  }
  public function moduleMODERATOR()
  {
    $this->Authentication();
    if ($this->filesMODERATOR($_GET['tab']) != null) {
      $this->_headINC();
      if (file_exists($this->filesMODERATOR($_GET['tab']))) {
        if ($_GET['tab'] == 'department') {
          $depList = $this->model->getDataList(array("table" => "department_tbl", "field" => "department_id as id,department_name as name", "sort_by" => "department_id ASC"));
        }
        if ($_GET['tab'] == 'newstype') {
          $categoryList = $this->model->getDataList(array("table" => "category_tbl", "field" => "category_id as id,category_name as name", "sort_by" => "category_id ASC"));
        }
        if ($_GET['tab'] == 'news') {
          $newsList = $this->model->getDataList(array("table" => "news_tbl a LEFT JOIN account_tbl b ON a.user_id=b.account_id LEFT JOIN category_tbl c ON a.category_id=c.category_id", "field" => "a.news_id as id,c.category_name,a.news_img_thumbnail_path as thumbnail,a.news_title as title,a.news_description as description,a.news_sticky as sticky,a.news_datetime_start as news_start,a.news_datetime_end as news_end,a.news_status as status,a.news_visit as visit,b.account_id,b.username,b.account_level as userlevel", "sort_by" => "a.news_id DESC"));
        }
        if ($_GET['tab'] == 'images') {
          $imagesList = $this->model->getDataList(array("table" => "news_img_tbl a LEFT JOIN account_tbl b ON a.user_id=b.account_id", "field" => "a.news_img_id as id,a.news_img_title as title,a.news_img_path as img_src,b.account_id,b.username,b.account_level as userlevel ", "sort_by" => "a.news_img_id DESC"));
        }
        if ($_GET['tab'] == 'setting') {
          $getData = $this->model->getData(array("table" => "web_config", "field" => "*", "where" => " id='1' "));
        }
        if ($_GET['tab'] == 'log') {
          $logList = $this->model->getDataList(array("table" => "website_log a LEFT JOIN account_tbl b ON a.user_id=b.account_id", "field" => "a.*,b.fullname", "sort_by" => "a.id DESC"));
        }
        if ($_GET['tab'] == 'report') {
          $where = '';
          if (!empty($_REQUEST['check_submit']) && !empty($_REQUEST['sdate']) && !empty($_REQUEST['department'])) {

            $exp_date =  explode(' - ', $_REQUEST['sdate']);
            $start = $exp_date[0];
            $end = $exp_date[1];
            $startDate = $this->xFunction->datetimeDB($exp_date[0]);
            $endDate = $this->xFunction->datetimeDB($exp_date[1]);

            $where .= "c.department_id='" . $_REQUEST['department'] . "'";
            $where .= " AND ( DATE(a.create_at) BETWEEN '" . $startDate . "' AND '" . $endDate . "'  )";
            $reportList = $this->model->getDataList(array("table" => "news_tbl a LEFT JOIN account_tbl b ON a.user_id=b.account_id LEFT JOIN department_news_tbl c ON a.news_id=c.news_id", "field" => "a.news_id as id,a.news_title as title,a.create_at,a.news_datetime_start as news_start,a.news_datetime_end as news_end,b.account_id,b.fullname", "where" => $where, "sort_by" => "a.news_id DESC"));

            $getData = $this->model->getData(array("table" => "department_tbl", "field" => "*", "where" => " department_id='" . $_REQUEST['department'] . "' "));

            $total = 0;
            if (is_array($reportList)) {
              foreach ($reportList as $value) {
                $total += 1;
              }
            }
          }

          $departmentList = $this->model->getDataList(array("table" => "department_tbl", "field" => "department_id as id,department_name as name", "sort_by" => "department_id ASC "));
        }
        include_once($this->filesMODERATOR($_GET['tab']));
      }
      $this->_footerINC();
    } else {
      $this->_page404();
    }
  }
  public function formMODERATOR()
  {
    if (isset($_POST['action']) && !empty($_POST['action'])) {
      if ($_POST['action'] == 'setting') {
        if (!empty($_FILES['breadcrumbs']['name'])) {
          $check_breadcrumbs = $this->model->getData(array("table" => "web_config", "field" => "id,breadcrumbs", "where" => " id='1' "));
          if (is_array($check_breadcrumbs) && !empty($check_breadcrumbs['id'])) {
            if (!empty($check_breadcrumbs['breadcrumbs'])) {
              @unlink($this->mediaFolder('breadcrumbs') . $check_breadcrumbs['breadcrumbs']);
            }
          }
          $file_ext = strtolower(end(explode('.', $_FILES['breadcrumbs']['name'])));
          $expensions = array("jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "gif", "GIF");
          $img_fail = '';
          if (in_array($file_ext, $expensions) === false) {
            $error_extension = $this->lang->alert->incorrect->img_extension_limit;
            $img_fail = 1;
          }
          if ($_FILES['breadcrumbs']['size'] > 5242880) {
            $error_sizelimit = $this->lang->alert->incorrect->files_size_limit;
            $img_fail = 1;
          }
          if ($_FILES['breadcrumbs']['error'] != true && empty($img_fail)) {
            $files_name = 'breadcrumbs_' . date('Ymd') . time() . '.' . $file_ext;
            $img_src = $this->mediaFolder('breadcrumbs') . $files_name;
            chmod($_FILES['breadcrumbs']['tmp_name'], 0755);
            /*uploadIMG*/
            $upload_img = $this->xFunction->uploadIMG($_FILES['breadcrumbs']['tmp_name'], $img_src);
            if ($upload_img === true) {
              $this->model->updateData(array("table" => "web_config", "field" => array("breadcrumbs" => $files_name), "where" => " id='1' "));
            }
            /*uploadIMG*/
          } else {
            $upload_fail = '';
            $upload_fail .= $this->lang->label->files . ': ' . $_FILES['breadcrumbs']['name'] . ' ' . $this->lang->alert->upload->fail . '\n';
            if (!empty($error_extension)) {
              $upload_fail .= '- ' . $error_extension . '\n';
            }
            if (!empty($error_sizelimit)) {
              $upload_fail .= '- ' . $error_sizelimit . '\n';
            }
            $this->xFunction->sAlert($upload_fail);
          } //check error
        } //check images1
        $this->xFunction->pageReload($this->lang->alert->save->success);
      }
      if ($_POST['action'] == 'department-create') {
        $var_name = $this->xFunction->htmlspec($_POST['name'], 1);
        $check = $this->model->getData(array("table" => "department_tbl", "field" => "department_id as id", "where" => " department_name='" . $var_name . "'"));
        if (empty($check['id'])) {
          $insert_id = $this->model->insertData(array("table" => "department_tbl", "field" => array("department_name" => $var_name)));
          if (!empty($insert_id)) {
            $this->xFunction->pageReload($this->lang->alert->save->success);
          } else {
            $this->xFunction->cssAlert('fail', $this->lang->alert->save->fail);
          }
        } else {
          $this->xFunction->cssAlert('fail', $this->lang->alert->duplicate->name);
        }
      } //department-create
      if ($_POST['action'] == 'department-update') {
        $var_id = $_POST['id'];
        $var_name = $this->xFunction->htmlspec($_POST['name'], 1);
        $check = $this->model->getData(array("table" => "department_tbl", "field" => "department_id as id", "where" => " department_id!='" . $var_id . "' AND department_name='" . $var_name . "'"));
        if (empty($check['id'])) {
          $update = $this->model->updateData(array("table" => "department_tbl", "field" => array("department_name" => $var_name), "where" => " department_id='" . $var_id . "' "));
          if ($update === true) {
            $this->xFunction->pageReload($this->lang->alert->save->success);
          } else {
            $this->xFunction->cssAlert('fail', $this->lang->alert->save->fail);
          }
        } else {
          $this->xFunction->cssAlert('fail', $this->lang->alert->duplicate->name);
        }
      } //department-update
      if ($_POST['action'] == 'department-select-del') {
        if ($this->checkUID('level') == 9) {
          $var_items = $_POST['items_list'];
          if (is_array($var_items)) {
            $items_array = array_values($var_items);
            $items_list = $this->xFunction->xEmpty($items_array);
            $dKeys = $this->xFunction->xDEL('department_id', $items_list);
            $delete = $this->model->deleteData(array("table" => "department_tbl", "where" => $dKeys));
            if ($delete === true) {
              $this->xFunction->pageReload($this->lang->alert->delete->success);
            } else {
              $this->xFunction->cssAlert('fail', $this->lang->alert->delete->fail);
            }
          } //is_array
        } else {
          $this->xFunction->cssAlert('fail', 'คุณไม่มีสิทธิ์ลบ!');
        }
      } //action = category-select-del
      if ($_POST['action'] == 'newstype-create') {
        $var_name = $this->xFunction->htmlspec($_POST['name'], 1);
        $check = $this->model->getData(array("table" => "category_tbl", "field" => "category_id as id", "where" => " category_name='" . $var_name . "'"));
        if (empty($check['id'])) {
          $insert_id = $this->model->insertData(array("table" => "category_tbl", "field" => array("category_name" => $var_name)));
          if (!empty($insert_id)) {
            $this->xFunction->pageReload($this->lang->alert->save->success);
          } else {
            $this->xFunction->cssAlert('fail', $this->lang->alert->save->fail);
          }
        } else {
          $this->xFunction->cssAlert('fail', $this->lang->alert->duplicate->name);
        }
      } //newstype-create
      if ($_POST['action'] == 'newstype-update') {
        $var_id = $_POST['id'];
        $var_name = $this->xFunction->htmlspec($_POST['name'], 1);
        $check = $this->model->getData(array("table" => "category_tbl", "field" => "category_id as id", "where" => " category_id!='" . $var_id . "' AND category_name='" . $var_name . "'"));
        if (empty($check['id'])) {
          $update = $this->model->updateData(array("table" => "category_tbl", "field" => array("category_name" => $var_name), "where" => " category_id='" . $var_id . "' "));
          if ($update === true) {
            $this->xFunction->pageReload($this->lang->alert->save->success);
          } else {
            $this->xFunction->cssAlert('fail', $this->lang->alert->save->fail);
          }
        } else {
          $this->xFunction->cssAlert('fail', $this->lang->alert->duplicate->name);
        }
      } //newstype-update
      if ($_POST['action'] == 'newstype-select-del') {
        if ($this->checkUID('level') == 9) {
          $var_items = $_POST['items_list'];
          if (is_array($var_items)) {
            $items_array = array_values($var_items);
            $items_list = $this->xFunction->xEmpty($items_array);
            $dKeys = $this->xFunction->xDEL('category_id', $items_list);
            $delete = $this->model->deleteData(array("table" => "category_tbl", "where" => $dKeys));
            if ($delete === true) {
              $this->xFunction->pageReload($this->lang->alert->delete->success);
            } else {
              $this->xFunction->cssAlert('fail', $this->lang->alert->delete->fail);
            }
          } //is_array
        } else {
          $this->xFunction->cssAlert('fail', 'คุณไม่มีสิทธิ์ลบ!');
        }
      } //action = newstype-select-del
    } //isset
  }
  /*moderator*/
  /*Account*/
  public function filesACCOUNT($tab)
  {
    if (isset($tab) && !empty($tab)) {
      switch ($tab) {
        case "list":
          return $this->_view . 'account/list.php';
          break;
        default:
          null;
      }
    }
  }
  public function moduleACCOUNT()
  {
    $this->Authentication();
    if ($this->filesACCOUNT($_GET['tab']) != null) {
      $this->_headINC();
      if (file_exists($this->filesACCOUNT($_GET['tab']))) {
        if ($_GET['tab'] == 'list') {
          $accountList = $this->model->getDataList(array("table" => "account_tbl", "field" => "account_id as id,username,fullname,email,reset_password,account_level as level,account_status as status", "sort_by" => "account_id DESC"));
        }
        include_once($this->filesACCOUNT($_GET['tab']));
      }
      $this->_footerINC();
    } else {
      $this->_page404();
    }
  }
  public function formACCOUNT()
  {
    if (isset($_POST['action']) && !empty($_POST['action'])) {
      if ($_POST['action'] == 'change-status') {
        if ($this->checkUID('level') == 9) {
          $var_id = $_POST['account_id'];
          $check = $this->model->getData(array("table" => "account_tbl", "field" => "account_id as id,account_status as status", "where" => " account_id='" . $var_id . "' "));
          if (is_array($check) && !empty($check['id'])) {
            if ($check['status'] == '1') {
              $var_status = '0';
            } else {
              $var_status = '1';
            }
            $update = $this->model->updateData(array("table" => "account_tbl", "field" => array("account_status" => $var_status), "where" => " account_id='" . $var_id . "' "));
            if ($update === true) {
              $this->xFunction->pageReload($this->lang->alert->notify->status_success);
            } else {
              $this->xFunction->pageReload($this->lang->alert->notify->fail);
            }
          } else {
            $this->xFunction->cssAlert('fail', $this->lang->alert->notfound->id . ' ' . $var_id . '!');
          }
        } else {
          $this->xFunction->cssAlert('fail', 'คุณไม่มีสิทธิ์เปลี่ยนสถานะผู้ใช้!');
        }
      } //action = change-status
      if ($_POST['action'] == 'reset-password') {
        $var_id = $_POST['account_id'];
        $check = $this->model->getData(array("table" => "account_tbl", "field" => "account_id as id", "where" => " account_id='" . $var_id . "' "));
        if (is_array($check) && !empty($check['id'])) {
          $rand_password = $this->xFunction->randcode(8);
          $new_password = md5($rand_password);
          $update = $this->model->updateData(array("table" => "account_tbl", "field" => array("password" => $new_password, "reset_password" => '1'), "where" => " account_id='" . $var_id . "' "));
          if ($update === true) {
            $link = $this->baseurl->backend->module->user->setPassword . $var_id . '&identify=' . $new_password;
            $script = '';
            $script .= '<script type="text/javascript">';
            $script .= '$(\'#modal-reset-password\').modal(\'show\');';
            $script .= '$(\'#reset_id\').val("' . $var_id . '");';
            $script .= '$(\'#reset_link\').val("' . $link . '");';
            $script .= '$(\'#reset_link\').focus();';
            $script .= '</script>';
            echo $script;
            //$this->xFunction->pageReload($this->lang->alert->notify->password_success);
          } else {
            $this->xFunction->pageReload($this->lang->alert->notify->fail);
          }
        } else {
          $this->xFunction->cssAlert('fail', $this->lang->alert->notfound->id . ' ' . $var_id . '!');
        }
      } //action = reset-password
    } //isset
  }
  /*Account*/
  /*SLIDE*/
  public function filesSLIDE($tab)
  {
    if (isset($tab) && !empty($tab)) {
      switch ($tab) {
        case "add":
          return $this->_view . 'slide/add.php';
          break;
        case "edit":
          return $this->_view . 'slide/edit.php';
          break;
        case "view":
          return $this->_view . 'slide/view.php';
          break;
        case "list":
          return $this->_view . 'slide/list.php';
          break;
        default:
          null;
      }
    }
  }
  public function moduleSLIDE()
  {
    $this->Authentication();
    if ($this->filesSLIDE($_GET['tab']) != null) {
      $this->_headINC();
      if (file_exists($this->filesSLIDE($_GET['tab']))) {
        if ($_GET['tab'] == 'list') {
          $slideList = $this->model->getDataList(array("table" => "banner_tbl", "field" => "banner_id as id,banner_img_path as img_thumb,banner_title as title,banner_order as sort_order,banner_status as status", "sort_by" => "banner_order DESC"));
        } //tab = list
        if ($_GET['tab'] == 'edit' || $_GET['tab'] == 'view') {
          if (isset($_GET['id']) && !empty($_GET['id'])) {
            $getData = $this->model->getData(array("table" => "banner_tbl", "field" => "banner_id as id,banner_img_path as img_thumb,banner_moblie_img_path as mb_img_thumb,banner_title as title,banner_description as description,banner_url as link_url,banner_order as sort_order,banner_order as sort_order,banner_status as status", "where" => " banner_id='" . $_GET['id'] . "' "));
          }
        } //tab = edit or view
        include_once($this->filesSLIDE($_GET['tab']));
      }
      $this->_footerINC();
    } else {
      $this->_page404();
    }
  }
  public function formSLIDE()
  {
    if (isset($_POST['action']) && !empty($_POST['action'])) {
      if ($_POST['action'] == 'save-data') {
        $var_title = $this->xFunction->htmlspec($_POST['title'], 1);
        $var_description = $this->xFunction->htmlspec($_POST['description'], 1);
        if (filter_var($_POST['link_url'], FILTER_VALIDATE_URL)) {
          $var_url = urlencode($_POST['link_url']);
        } else {
          $var_url = '';
        }
        $var_order = $_POST['sort_order'];
        $var_status = $_POST['status'];
        $insert = $this->model->insertData(array("table" => "banner_tbl", "field" => array("banner_title" => $var_title, "banner_description" => $var_description, "banner_url" => $var_url, "banner_order" => $var_order, "banner_status" => $var_status)));
        if (!empty($insert)) {
          if (empty($var_order)) {
            $this->model->updateData(array("table" => "banner_tbl", "field" => array("banner_order" => $insert), "where" => " banner_id='" . $insert . "' "));
          }
          if (!empty($_FILES['images1']['name'])) {
            $file_ext = strtolower(end(explode('.', $_FILES['images1']['name'])));
            $expensions = array("jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "gif", "GIF");
            $img_fail = '';
            if (in_array($file_ext, $expensions) === false) {
              $error_extension = $this->lang->alert->incorrect->img_extension_limit;
              $img_fail = 1;
            }
            if ($_FILES['images1']['size'] > 5242880) {
              $error_sizelimit = $this->lang->alert->incorrect->files_size_limit;
              $img_fail = 1;
            }
            if ($_FILES['images1']['error'] != true && empty($img_fail)) {
              $files_name = 'banner_' . $insert . date('Ymd') . time() . '.' . $file_ext;
              $img_src = $this->mediaFolder('banner') . $files_name;
              chmod($_FILES['images1']['tmp_name'], 0755);
              /*uploadIMG*/
              $upload_img = $this->xFunction->uploadIMG($_FILES['images1']['tmp_name'], $img_src);
              if ($upload_img === true) {
                $this->model->updateData(array("table" => "banner_tbl", "field" => array("banner_img_path" => $files_name), "where" => " banner_id='" . $insert . "' "));
              }
              /*uploadIMG*/
            } else {
              $upload_fail = '';
              $upload_fail .= $this->lang->label->files . ': ' . $_FILES['images1']['name'] . ' ' . $this->lang->alert->upload->fail . '\n';
              if (!empty($error_extension)) {
                $upload_fail .= '- ' . $error_extension . '\n';
              }
              if (!empty($error_sizelimit)) {
                $upload_fail .= '- ' . $error_sizelimit . '\n';
              }
              $this->xFunction->sAlert($upload_fail);
            } //check error
          } //check images1
          if (!empty($_FILES['images2']['name'])) {
            $file_ext2 = strtolower(end(explode('.', $_FILES['images2']['name'])));
            $expensions2 = array("jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "gif", "GIF");
            $img_fail2 = '';
            if (in_array($file_ext2, $expensions2) === false) {
              $error_extension2 = $this->lang->alert->incorrect->img_extension_limit;
              $img_fail2 = 1;
            }
            if ($_FILES['images2']['size'] > 5242880) {
              $error_sizelimit2 = $this->lang->alert->incorrect->files_size_limit;
              $img_fail2 = 1;
            }
            if ($_FILES['images2']['error'] != true && empty($img_fail2)) {
              $files_name2 = 'mbbanner_' . $insert . date('Ymd') . time() . '.' . $file_ext2;
              $img_src2 = $this->mediaFolder('banner') . $files_name2;
              chmod($_FILES['images2']['tmp_name'], 0755);
              /*uploadIMG*/
              $upload_img2 = $this->xFunction->uploadIMG($_FILES['images2']['tmp_name'], $img_src2);
              if ($upload_img2 === true) {
                $this->model->updateData(array("table" => "banner_tbl", "field" => array("banner_moblie_img_path" => $files_name2), "where" => " banner_id='" . $insert . "' "));
              }
              /*uploadIMG*/
            } else {
              $upload_fail2 = '';
              $upload_fail2 .= $this->lang->label->files . ': ' . $_FILES['images2']['name'] . ' ' . $this->lang->alert->upload->fail . '\n';
              if (!empty($error_extension2)) {
                $upload_fail2 .= '- ' . $error_extension2 . '\n';
              }
              if (!empty($error_sizelimit2)) {
                $upload_fail2 .= '- ' . $error_sizelimit2 . '\n';
              }
              $this->xFunction->sAlert($upload_fail2);
            } //check error
          } //check images2
          $this->xFunction->pageReload($this->lang->alert->save->success, $this->baseurl->backend->module->slide->list);
        } else {
          $this->xFunction->cssAlert('error', $this->lang->alert->save->fail);
        }
      } //action = save-data
      if ($_POST['action'] == 'update-data') {
        $var_id = $_POST['id'];
        $check = $this->model->getData(array("table" => "banner_tbl", "field" => "banner_id as id,banner_img_path as img_path,banner_moblie_img_path as mb_img_path", "where" => " banner_id='" . $var_id . "' "));
        if (is_array($check) && !empty($check['id'])) {
          $check_images1 = '';
          if ($_POST['del_images1'] == 1) {
            $check_images1 = 1;
          } else if (!empty($_FILES['images1']['name'])) {
            $check_images1 = 1;
          } else {
            $check_images1 = '';
          }
          if ($check_images1 == 1 && !empty($check['img_path'])) {
            @unlink($this->mediaFolder('banner') . $check['img_path']);
            $this->model->updateData(array("table" => "banner_tbl", "field" => array("banner_img_path" => ''), "where" => " banner_id='" . $var_id . "' "));
          }
          if (!empty($_FILES['images1']['name'])) {
            $file_ext = strtolower(end(explode('.', $_FILES['images1']['name'])));
            $expensions = array("jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "gif", "GIF");
            $img_fail = '';
            if (in_array($file_ext, $expensions) === false) {
              $error_extension = $this->lang->alert->incorrect->img_extension_limit;
              $img_fail = 1;
            }
            if ($_FILES['images1']['size'] > 5242880) {
              $error_sizelimit = $this->lang->alert->incorrect->files_size_limit;
              $img_fail = 1;
            }
            if ($_FILES['images1']['error'] != true && empty($img_fail)) {
              $files_name = 'banner_' . $var_id . date('Ymd') . time() . '.' . $file_ext;
              $img_src = $this->mediaFolder('banner') . $files_name;
              chmod($_FILES['images1']['tmp_name'], 0755);
              /*uploadIMG*/
              $upload_img = $this->xFunction->uploadIMG($_FILES['images1']['tmp_name'], $img_src);
              if ($upload_img === true) {
                $this->model->updateData(array("table" => "banner_tbl", "field" => array("banner_img_path" => $files_name), "where" => " banner_id='" . $var_id . "' "));
              }
              /*uploadIMG*/
            } else {
              $upload_fail = '';
              $upload_fail .= $this->lang->label->files . ': ' . $_FILES['images1']['name'] . ' ' . $this->lang->alert->upload->fail . '\n';
              if (!empty($error_extension)) {
                $upload_fail .= '- ' . $error_extension . '\n';
              }
              if (!empty($error_sizelimit)) {
                $upload_fail .= '- ' . $error_sizelimit . '\n';
              }
              $this->xFunction->sAlert($upload_fail);
            } //check error
          } //check images1
          $check_images2 = '';
          if ($_POST['del_images2'] == 1) {
            $check_images2 = 1;
          } else if (!empty($_FILES['images2']['name'])) {
            $check_images2 = 1;
          } else {
            $check_images2 = '';
          }
          if ($check_images2 == 1 && !empty($check['mb_img_path'])) {
            @unlink($this->mediaFolder('banner') . $check['mb_img_path']);
            $this->model->updateData(array("table" => "banner_tbl", "field" => array("banner_moblie_img_path" => ''), "where" => " banner_id='" . $var_id . "' "));
          }
          if (!empty($_FILES['images2']['name'])) {
            $file_ext2 = strtolower(end(explode('.', $_FILES['images2']['name'])));
            $expensions2 = array("jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "gif", "GIF");
            $img_fail2 = '';
            if (in_array($file_ext2, $expensions2) === false) {
              $error_extension2 = $this->lang->alert->incorrect->img_extension_limit;
              $img_fail2 = 1;
            }
            if ($_FILES['images2']['size'] > 5242880) {
              $error_sizelimit2 = $this->lang->alert->incorrect->files_size_limit;
              $img_fail2 = 1;
            }
            if ($_FILES['images2']['error'] != true && empty($img_fail2)) {
              $files_name2 = 'mbbanner_' . $var_id . date('Ymd') . time() . '.' . $file_ext2;
              $img_src2 = $this->mediaFolder('banner') . $files_name2;
              chmod($_FILES['images2']['tmp_name'], 0755);
              /*uploadIMG*/
              $upload_img2 = $this->xFunction->uploadIMG($_FILES['images2']['tmp_name'], $img_src2);
              if ($upload_img2 === true) {
                $this->model->updateData(array("table" => "banner_tbl", "field" => array("banner_moblie_img_path" => $files_name2), "where" => " banner_id='" . $var_id . "' "));
              }
              /*uploadIMG*/
            } else {
              $upload_fail2 = '';
              $upload_fail2 .= $this->lang->label->files . ': ' . $_FILES['images2']['name'] . ' ' . $this->lang->alert->upload->fail . '\n';
              if (!empty($error_extension2)) {
                $upload_fail2 .= '- ' . $error_extension2 . '\n';
              }
              if (!empty($error_sizelimit2)) {
                $upload_fail2 .= '- ' . $error_sizelimit2 . '\n';
              }
              $this->xFunction->sAlert($upload_fail2);
            } //check error
          } //check images2
          $var_title = $this->xFunction->htmlspec($_POST['title'], 1);
          $var_description = $this->xFunction->htmlspec($_POST['description'], 1);
          if (filter_var($_POST['link_url'], FILTER_VALIDATE_URL)) {
            $var_url = urlencode($_POST['link_url']);
          } else {
            $var_url = '';
          }
          $var_order = $_POST['sort_order'];
          $var_status = $_POST['status'];
          $update = $this->model->updateData(array("table" => "banner_tbl", "field" => array("banner_title" => $var_title, "banner_description" => $var_description, "banner_url" => $var_url, "banner_order" => $var_order, "banner_status" => $var_status), "where" => " banner_id='" . $var_id . "' "));
          if ($update === true) {
            $this->xFunction->pageReload($this->lang->alert->save->success);
          } else {
            $this->xFunction->cssAlert('error', $this->lang->alert->save->fail);
          }
        } //is_array
      } //action = update-data
      if ($_POST['action'] == 'change-status') {
        $var_id = $_POST['banner_id'];
        $check = $this->model->getData(array("table" => "banner_tbl", "field" => "banner_id as id,banner_status as status", "where" => " banner_id='" . $var_id . "' "));
        if (is_array($check) && !empty($check['id'])) {
          if ($check['status'] == '1') {
            $var_status = '0';
          } else {
            $var_status = '1';
          }
          $update = $this->model->updateData(array("table" => "banner_tbl", "field" => array("banner_status" => $var_status), "where" => " banner_id='" . $var_id . "' "));
          if ($update === true) {
            $this->xFunction->pageReload($this->lang->alert->notify->status_success);
          } else {
            $this->xFunction->pageReload($this->lang->alert->notify->fail);
          }
        } else {
          $this->xFunction->cssAlert('fail', $this->lang->alert->notfound->id . ' ' . $var_id . '!');
        }
      } //action = change-status
      if ($_POST['action'] == 'edit-ranking') {
        $var_id = $_POST['banner_id'];
        $var_ranking = $_POST['ranking'];
        $check = $this->model->getData(array("table" => "banner_tbl", "field" => "banner_id as id", "where" => " banner_id='" . $var_id . "' "));
        if (is_array($check) && !empty($check['id'])) {
          $update = $this->model->updateData(array("table" => "banner_tbl", "field" => array("banner_order" => $var_ranking), "where" => " banner_id='" . $var_id . "' "));
          if ($update === true) {
            $this->xFunction->pageReload($this->lang->alert->save->success);
          } else {
            $this->xFunction->pageReload($this->lang->alert->save->fail);
          }
        } else {
          $this->xFunction->cssAlert('fail', $this->lang->alert->notfound->id . ' ' . $var_id . '!');
        }
      } //action = edit-ranking
      if ($_POST['action'] == 'select-del') {
        if ($this->checkUID('level') == 9) {
          $var_items = $_POST['items_list'];
          if (is_array($var_items)) {
            $items_array = array_values($var_items);
            $items_list = $this->xFunction->xEmpty($items_array);
            if (is_array($items_list)) {
              foreach ($items_list as $ekeys => $eval) {
                $check = $this->model->getData(array("table" => "banner_tbl", "field" => "banner_id as id,banner_img_path as banner,banner_moblie_img_path as banner_moblie", "where" => " banner_id='" . $eval . "' "));
                if (is_array($check) && !empty($check['id'])) {
                  if (!empty($check['banner'])) {
                    @unlink($this->mediaFolder('banner') . $check['banner']);
                  }
                  if (!empty($check['banner_moblie'])) {
                    @unlink($this->mediaFolder('banner') . $check['banner_moblie']);
                  }
                }
              } //foreach
            } //check items_list
            $dKeys = $this->xFunction->xDEL('banner_id', $items_list);
            $delete = $this->model->deleteData(array("table" => "banner_tbl", "where" => $dKeys));
            if ($delete === true) {
              $this->xFunction->pageReload($this->lang->alert->delete->success);
            } else {
              $this->xFunction->cssAlert('fail', $this->lang->alert->delete->fail);
            }
          } //is_array
        } else {
          $this->xFunction->cssAlert('fail', 'คุณไม่มีสิทธิ์ลบ!');
        }
      } //action = select-del
    } //isset
  }
  /*SLIDE*/
  /*NEWS*/
  public function filesNEWS($tab)
  {
    if (isset($tab) && !empty($tab)) {
      switch ($tab) {
        case "add":
          return $this->_view . 'news/add.php';
          break;
        case "list":
          return $this->_view . 'news/list.php';
          break;
        case "manage":
          return $this->_view . 'news/manage.php';
          break;
        case "view":
          return $this->_view . 'news/view.php';
          break;
        case "images":
          return $this->_view . 'news/images.php';
          break;
        default:
          null;
      }
    }
  }
  public function moduleNEWS()
  {
    $this->Authentication();
    if ($this->filesNEWS($_GET['tab']) != null) {
      $this->_headINC();
      if (file_exists($this->filesNEWS($_GET['tab']))) {
        if ($_GET['tab'] == 'add') {
          $user_id = $this->checkUID('id');
          $categoryList = $this->model->getDataList(array("table" => "category_tbl", "field" => "category_id as id,category_name as name", "sort_by" => "category_id ASC "));
          $departmentList = $this->model->getDataList(array("table" => "department_tbl", "field" => "department_id as id,department_name as name", "sort_by" => "department_id ASC "));
          $getData = $this->model->getData(array("table" => "reserve_news_thumbnail", "field" => "news_thumbnail_id as id,news_thumbnail_path as thumbnail", "where" => " user_id='" . $user_id . "'"));
          $galleryList = $this->model->getDataList(array("table" => "reserve_gallery", "field" => "gallery_id as id", "where" => " user_id='" . $user_id . "'", "sort_by" => "gallery_id ASC "));
        }
        if ($_GET['tab'] == 'list') {
          $newsList = $this->model->getDataList(array("table" => "news_tbl a LEFT JOIN category_tbl b ON a.category_id=b.category_id", "field" => "a.news_id as id,b.category_name,a.news_img_thumbnail_path as thumbnail,a.news_title as title,a.news_description as description,a.news_sticky as sticky,a.news_datetime_start as news_start,a.news_datetime_end as news_end,a.news_status as status,a.news_visit as visit", "where" => " user_id='" . $this->checkUID('id') . "'", "sort_by" => "a.news_id DESC"));
        }
        if ($_GET['tab'] == 'images') {
          $imagesList = $this->model->getDataList(array("table" => "news_img_tbl", "field" => "news_img_id as id,news_img_title as title,news_img_path as img_src ", "where" => " user_id='" . $this->checkUID('id') . "'", "sort_by" => "news_img_id DESC"));
        }
        if ($_GET['tab'] == 'manage') {
          if (isset($_GET['id']) && !empty($_GET['id'])) {
            $add_where = "";
            $callback = "";
            if ($this->checkUID('level') == 9 || $this->checkUID('level') == 8) {
              $add_where .= "";
              if ($_GET['click'] == 'moderator') {
                $callback .= $this->baseurl->backend->module->moderator->news;
              } else {
                $callback .= $this->baseurl->backend->module->news->list;
              }
            } else {
              $user_id = $this->checkUID('id');
              $add_where .= " AND user_id='" . $user_id . "'";
              $callback .= $this->baseurl->backend->module->news->list;
            }
            $categoryList = $this->model->getDataList(array("table" => "category_tbl", "field" => "category_id as id,category_name as name", "sort_by" => "category_id ASC "));
            $departmentList = $this->model->getDataList(array("table" => "department_tbl", "field" => "department_id as id,department_name as name", "sort_by" => "department_id ASC "));
            $getData = $this->model->getData(array("table" => "news_tbl", "field" => "news_id as id,news_img_thumbnail_path as thumbnail,category_id as category,department_list as department,news_title as title,news_overview as overview,news_description as description,news_youtube as youtube,news_sticky as sticky,news_datetime_start as news_start,news_datetime_end as news_end,news_visit as visit,news_status as status,user_id,create_at", "where" => " news_id='" . $_GET['id'] . "'" . $add_where));
          } //isset
        } //tab = edit
        if ($_GET['tab'] == 'view') {
          if (isset($_GET['id']) && !empty($_GET['id'])) {
            $add_where = "";
            $callback = "";
            $add_param = "";
            if ($this->checkUID('level') == 9 || $this->checkUID('level') == 8) {
              $add_where .= "";
              if ($_GET['click'] == 'moderator') {
                $callback .= $this->baseurl->backend->module->moderator->news;
              } else {
                $callback .= $this->baseurl->backend->module->news->list;
              }
              $add_param .= "&click=moderator";
            } else {
              $user_id = $this->checkUID('id');
              $add_where .= " AND user_id='" . $user_id . "'";
              $callback .= $this->baseurl->backend->module->news->list;
              $add_param .= "";
            }
            $getData = $this->model->getData(array("table" => "news_tbl", "field" => "news_id as id,news_img_thumbnail_path as thumbnail,category_id as category,department_list as department,news_title as title,news_overview as overview,news_description as description,news_youtube as youtube,news_sticky as sticky,news_datetime_start as news_start,news_datetime_end as news_end,news_visit as visit,news_status as status,create_at", "where" => " news_id='" . $_GET['id'] . "'" . $add_where));
          } //isset
        } //tab = view
        include_once($this->filesNEWS($_GET['tab']));
      }
      $this->_footerINC();
    } else {
      $this->_page404();
    }
  }
  public function formNEWS()
  {
    if (isset($_POST['action']) && !empty($_POST['action'])) {
      if ($_POST['action'] == 'save-reserve-thumbnail') {
        if (!empty($_POST['thumbnail'])) {
          $user_id = $this->checkUID('id');
          $check_thumbnail = $this->model->getData(array("table" => "reserve_news_thumbnail", "field" => "news_thumbnail_id as id,news_thumbnail_path as thumbnail", "where" => " user_id='" . $user_id . "' "));
          if (is_array($check_thumbnail) && !empty($check_thumbnail['thumbnail'])) {
            @unlink($this->ReserveMediaFolder('news_thumbnail') . $check_thumbnail['thumbnail']);
            $this->model->deleteData(array("table" => "reserve_news_thumbnail", "where" => " user_id='" . $user_id . "'"));
          }
          $data = $_POST['thumbnail'];
          list($type, $data) = explode(';', $data);
          list(, $data) = explode(',', $data);
          $data = base64_decode($data);
          if ($type == 'data:image/png' || $type == 'data:image/jpeg') {
            $run = $this->checkUID('sid');
            $file_name = 'reserve_' . $run . '_' . date('YmdHis') . '.png';
            $file_src = $this->ReserveMediaFolder('news_thumbnail') . $file_name;
            $upload = file_put_contents($this->ReserveMediaFolder('news_thumbnail') . $file_name, $data);
            if (!empty($upload)) {
              chmod($file_src, 0755);
              $insert = $this->model->insertData(array("table" => "reserve_news_thumbnail", "field" => array("news_thumbnail_path" => $file_name, "user_id" => $user_id)));
              if (!empty($insert)) {
                $this->xFunction->autoCLICK('eclose-modal');
                $this->xFunction->showIMG($this->ReserveMediaURL('news_thumbnail') . $file_name);
                $this->xFunction->hideHTML('.thumb_del');
              } else {
                $this->xFunction->sAlert($this->lang->alert->fail->proceed);
              }
            } else {
              $this->xFunction->sAlert($this->lang->alert->fail->proceed);
            }
          } else {
            $this->xFunction->sAlert($this->lang->alert->fail->proceed);
          } //check data:image/png
        } //check empty
      } //action = reserve-save-thumbnail
      if ($_POST['action'] == 'reserve-thumbnail-delete') {
        $user_id = $this->checkUID('id');
        $check = $this->model->getData(array("table" => "reserve_news_thumbnail", "field" => "news_thumbnail_id as id,news_thumbnail_path as img_src", "where" => " user_id='" . $user_id . "'"));
        if (is_array($check) && !empty($check['id'])) {
          if (!empty($check['img_src'])) {
            @unlink($this->ReserveMediaFolder('news_thumbnail') . $check['img_src']);
          }
        }
        $delete = $this->model->deleteData(array("table" => "reserve_news_thumbnail", "where" => " user_id='" . $user_id . "'"));
        if ($delete === true) {
          $this->xFunction->hideHTML('.thumb_del');
          $this->xFunction->sAlert($this->lang->alert->delete->success);
        } else {
          $this->xFunction->cssAlert('fail', $this->lang->alert->delete->fail);
        }
      } //action = reserve-thumbnail-delete
      if ($_POST['action'] == 'upload-reserve-gallery') {
        $user_id = $this->checkUID('id');
        if ($_POST['image_form_submit'] == 1) {
          $no = 1;
          $check = 0;
          $import = 0;
          $check_img = count($_FILES['images']['name']);
          if ($check_img > 0) {
            foreach ($_FILES['images']['name'] as $key => $val) {
              $file_ext = strtolower(end(explode('.', $_FILES['images']['name'][$key])));
              $expensions = array("jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "gif", "GIF");
              $img_fail = '';
              if (in_array($file_ext, $expensions) === false) {
                $error_extension = $this->lang->alert->incorrect->img_extension_limit;
                $img_fail = 1;
              }
              if ($_FILES['images']['size'][$key] > 5242880) {
                $error_sizelimit = $this->lang->alert->incorrect->files_size_limit;
                $img_fail = 1;
              }
              if ($_FILES['images']['error'][$key] != true && empty($img_fail)) {
                $image_title = $this->xFunction->getNANE($_FILES['images']['name'][$key]);
                $insert_id = $this->model->insertData(array("table" => "reserve_gallery", "field" => array("gallery_title" => $image_title, "gallery_path" => '', "user_id" => $user_id)));
                if (!empty($insert_id)) {
                  $runtime = date("YmdHis");
                  $files_name = 'reserve_' . $user_id . 'U' . $insert_id . 'T' . $runtime . '.' . $file_ext;
                  $img_src = $this->ReserveMediaFolder('gallery_original') . $files_name;
                  $img_traget = $this->ReserveMediaFolder('gallery') . $files_name;
                  chmod($_FILES['images']['tmp_name'][$key], 0755);
                  /*uploadIMG*/
                  $upload_img = $this->xFunction->uploadIMG($_FILES['images']['tmp_name'][$key], $img_src);
                  if ($upload_img === true) {
                    $this->xFunction->resizeIMG(1170, $img_traget, $img_src);
                    $this->model->updateData(array("table" => "reserve_gallery", "field" => array("gallery_path" => $files_name), "where" => " gallery_id='" . $insert_id . "' "));
                  } else {
                    $this->model->deleteData(array("table" => "reserve_gallery", "where" => " gallery_id='" . $insert_id . "' "));
                  }
                  /*uploadIMG*/
                  $import++;
                }
              } else {
                $upload_fail = '';
                $upload_fail .= $this->lang->label->files . ': ' . $_FILES['images']['name'][$key] . ' ' . $this->lang->alert->upload->fail . '\n';
                if (!empty($error_extension)) {
                  $upload_fail .= '- ' . $error_extension . '\n';
                }
                if (!empty($error_sizelimit)) {
                  $upload_fail .= '- ' . $error_sizelimit . '\n';
                }
                $this->xFunction->sAlert($upload_fail);
              } //check error
              $no++;
              $check++;
            } //foreach
          } //check count
          if ($check_img == $check && !empty($import)) {
            $addthis = '';
            $addthis .= ' load_reserve_gallery(); ';
            $addthis .= ' load_reserve_manage_gallery(); ';
            $addthis .= '$(\'#modal-images-manage\').modal(\'show\');';
            $addthis .= '$(\'#close-modal\').click();';
            $this->xFunction->sAlert($this->lang->alert->success->proceed, $addthis);
          }
        } //image_form_submit
      } //action = upload-reserve-gallery
      if ($_POST['action'] == 'update-reserve-gallery-title') {
        $user_id = $this->checkUID('id');
        $items_title = array();
        parse_str($_POST['items_title'], $items_title);
        if (is_array($items_title)) {
          $no = 1;
          if (count($items_title['gallery_title']) > 0) {
            foreach ($items_title['gallery_title'] as $keys => $values) {
              $this->model->updateData(array("table" => "reserve_gallery", "field" => array("gallery_title" => $values), "where" => " gallery_id='" . $keys . "' AND user_id='" . $user_id . "' "));
              if ($no == count($items_title['gallery_title'])) {
                $addthis = '';
                $addthis .= ' load_reserve_gallery(); ';
                $addthis .= ' load_reserve_manage_gallery(); ';
                $this->xFunction->sAlert($this->lang->alert->save->success, $addthis);
              }
              $no++;
            } //foreach
          }
        } //is_array
      } //action = update-reserve-gallery-title
      if ($_POST['action'] == 'select-reserve-gallery-del') {
        $user_id = $this->checkUID('id');
        $var_items = $_POST['items_list'];
        if (is_array($var_items)) {
          $items_array = array_values($var_items);
          $items_list = $this->xFunction->xEmpty($items_array);
          if (is_array($items_list)) {
            foreach ($items_list as $ekeys => $eval) {
              $check = $this->model->getData(array("table" => "reserve_gallery", "field" => "gallery_id as id,gallery_path as img_src", "where" => " gallery_id='" . $eval . "' AND user_id='" . $user_id . "' "));
              if (is_array($check) && !empty($check['id'])) {
                if (!empty($check['img_src'])) {
                  @unlink($this->ReserveMediaFolder('gallery') . $check['img_src']);
                }
              }
            } //foreach
          } //check items_list
          $dKeys = $this->xFunction->xDEL('gallery_id', $items_list);
          $delete = $this->model->deleteData(array("table" => "reserve_gallery", "where" => $dKeys));
          if ($delete === true) {
            $addthis = '';
            $addthis .= ' load_reserve_gallery(); ';
            $addthis .= ' load_reserve_manage_gallery(); ';
            $this->xFunction->sAlert($this->lang->alert->delete->success, $addthis);
          } else {
            $this->xFunction->cssAlert('fail', $this->lang->alert->delete->fail);
          }
        } //is_array
      } //action = select-reserve-gallery-del
      if ($_POST['action'] == 'upload-reserve-attachment') {
        $user_id = $this->checkUID('id');
        if ($_POST['files_form_submit'] == 1) {
          $no = 1;
          $check = 0;
          $import = 0;
          $check_files = count($_FILES['files']['name']);
          if ($check_files > 0) {
            foreach ($_FILES['files']['name'] as $key => $val) {
              $file_ext = strtolower(end(explode('.', $_FILES['files']['name'][$key])));
              $expensions = array("pdf", "doc", "docx", "xls", "xlsx");
              $error = '';
              if (in_array($file_ext, $expensions) === false) {
                $error_extension = $this->lang->alert->incorrect->files_extensions_limit;
                $error = 1;
              }
              if ($_FILES['files']['size'][$key] > 5242880) {
                $error_sizelimit = $this->lang->alert->incorrect->files_size_limit;
                $error = 1;
              }
              if ($_FILES['files']['error'][$key] != true && empty($error)) {
                $files_title = $this->xFunction->getNANE($_FILES['files']['name'][$key]);
                $insert_id = $this->model->insertData(array("table" => "reserve_news_files", "field" => array("news_files_title" => $files_title, "news_files_path" => '', "user_id" => $user_id)));
                if (!empty($insert_id)) {
                  $runtime = date("YmdHis");
                  $files_name = 'reserve_' . $insert_id . 'T' . $runtime . '.' . $file_ext;
                  $files_src = $this->ReserveFilesFolder('news') . $files_name;
                  chmod($_FILES['files']['tmp_name'][$key], 0755);
                  /*uploadfiles*/
                  $upload_files = $this->xFunction->uploadIMG($_FILES['files']['tmp_name'][$key], $files_src);
                  if ($upload_files === true) {
                    $this->model->updateData(array("table" => "reserve_news_files", "field" => array("news_files_path" => $files_name), "where" => " news_files_id='" . $insert_id . "' "));
                  } else {
                    $this->model->deleteData(array("table" => "reserve_news_files", "where" => " news_files_id='" . $insert_id . "' "));
                  }
                  /*uploadfiles*/
                  $import++;
                }
              } else {
                $upload_fail = '';
                $upload_fail .= $this->lang->label->files . ': ' . $_FILES['files']['name'][$key] . ' ' . $this->lang->alert->upload->fail . '\n';
                if (!empty($error_extension)) {
                  $upload_fail .= '- ' . $error_extension . '\n';
                }
                if (!empty($error_sizelimit)) {
                  $upload_fail .= '- ' . $error_sizelimit . '\n';
                }
                $this->xFunction->sAlert($upload_fail);
              } //check error
              $no++;
              $check++;
            } //foreach
          } //check count
          if ($check_files == $check && !empty($import)) {
            $addthis = '';
            $addthis .= ' load_reserve_attachment(' . $var_id . '); ';
            $addthis .= ' load_reserve_manage_attachment(' . $var_id . '); ';
            $addthis .= '$(\'#modal-files-manage\').modal(\'show\');';
            $addthis .= '$(\'#fclose-modal\').click();';
            $this->xFunction->sAlert($this->lang->alert->success->proceed, $addthis);
          }
        } //files_form_submit
      } //action = upload-reserve-files
      if ($_POST['action'] == 'update-reserve-files-title') {
        $user_id = $this->checkUID('id');
        $items_title = array();
        parse_str($_POST['items_title'], $items_title);
        if (is_array($items_title)) {
          $no = 1;
          if (count($items_title['files_title']) > 0) {
            foreach ($items_title['files_title'] as $keys => $values) {
              $this->model->updateData(array("table" => "reserve_news_files", "field" => array("news_files_title" => $values), "where" => " news_files_id='" . $keys . "' AND user_id='" . $user_id . "' "));
              if ($no == count($items_title['files_title'])) {
                $addthis = '';
                $addthis .= ' load_reserve_attachment(); ';
                $addthis .= ' load_reserve_manage_attachment(); ';
                $this->xFunction->sAlert($this->lang->alert->save->success, $addthis);
              }
              $no++;
            } //foreach
          } //count
        } //is_array
      } //action = update-reserve-gallery-title
      if ($_POST['action'] == 'select-reserve-files-del') {
        $user_id = $this->checkUID('id');
        $var_items = $_POST['items_list'];
        if (is_array($var_items)) {
          $items_array = array_values($var_items);
          $items_list = $this->xFunction->xEmpty($items_array);
          if (is_array($items_list)) {
            foreach ($items_list as $ekeys => $eval) {
              $check = $this->model->getData(array("table" => "reserve_news_files", "field" => "news_files_id as id,news_files_path as files_src", "where" => " news_files_id='" . $eval . "' AND user_id='" . $user_id . "' "));
              if (is_array($check) && !empty($check['id'])) {
                if (!empty($check['files_src'])) {
                  @unlink($this->ReserveFilesFolder('news') . $check['files_src']);
                }
              }
            } //foreach
          } //check items_list
          $dKeys = $this->xFunction->xDEL('news_files_id', $items_list);
          $delete = $this->model->deleteData(array("table" => "reserve_news_files", "where" => $dKeys));
          if ($delete === true) {
            $addthis = '';
            $addthis .= ' load_reserve_attachment(); ';
            $addthis .= ' load_reserve_manage_attachment(); ';
            $this->xFunction->sAlert($this->lang->alert->delete->success, $addthis);
          } else {
            $this->xFunction->cssAlert('fail', $this->lang->alert->delete->fail);
          }
        } //is_array
      } //action = select-reserve-files-del
      if ($_POST['action'] == 'create-news') {
        $user_id = $this->checkUID('id');
        $var_category = $_POST['category'];
        $var_title = $this->xFunction->htmlspec($_POST['title'], 1);
        $var_overview = $this->xFunction->htmlspec($_POST['overview'], 1);
        $var_description = $this->xFunction->htmlspec($_POST['description'], 1);
        $var_youtube = urlencode($_POST['youtube']);
        if ($this->checkUID('level') == 9) {
          $var_sticky = $_POST['sticky'];
          $var_status = $_POST['status'];
        }
        $var_datestart = $this->xFunction->datetimeDB($_POST['news_start']);
        $var_dateend = $this->xFunction->datetimeDB($_POST['news_end']);
        $var_department = $_POST['department'];
        if ($this->checkUID('level') == 9) {
          $insert = $this->model->insertData(array("table" => "news_tbl", "field" => array("category_id" => $var_category, "department_list" => $var_department, "news_title" => $var_title, "news_overview" => $var_overview, "news_description" => $var_description, "news_youtube" => $var_youtube, "news_sticky" => $var_sticky, "news_status" => $var_status, "news_datetime_start" => $var_datestart, "news_datetime_end" => $var_dateend, "create_at" => date("Y-m-d H:i:s"), "user_id" => $user_id)));
        } else {
          $insert = $this->model->insertData(array("table" => "news_tbl", "field" => array("category_id" => $var_category, "department_list" => $var_department, "news_title" => $var_title, "news_overview" => $var_overview, "news_description" => $var_description, "news_youtube" => $var_youtube, "news_datetime_start" => $var_datestart, "news_datetime_end" => $var_dateend, "create_at" => date("Y-m-d H:i:s"), "user_id" => $user_id)));
        }
        if (!empty($insert)) {
          /*Save Log*/
          $log_note = 'รหัส : ' . $insert . ' / หัวข้อ :' . $var_title;
          $this->model->insertData(array("table" => "website_log", "field" => array("user_id" => $user_id, "status" => 3, "note" => $log_note, "create_at" => date("Y-m-d H:i:s"))));
          /*Save Log*/

          $var_id = $insert;
          if (!empty($var_department)) {
            $exp_department = explode(',', $var_department);
            if (is_array($exp_department) && count($exp_department) > 0) {
              foreach ($exp_department as $key => $department) {
                $this->model->insertData(array("table" => "department_news_tbl", "field" => array("news_id" => $var_id, "department_id" => $department)));
              }
            } //is_array
          } //empty >> department
          $check_thumbnail = $this->model->getData(array("table" => "reserve_news_thumbnail", "field" => "news_thumbnail_id as id,news_thumbnail_path as thumbnail", "where" => " user_id='" . $user_id . "' "));
          if (is_array($check_thumbnail) && !empty($check_thumbnail['id'])) {
            if (!empty($check_thumbnail['thumbnail'])) {
              $thumbnail_reserve = $this->ReserveMediaFolder('news_thumbnail') . $check_thumbnail['thumbnail'];
              $thumbnail_info = pathinfo($thumbnail_reserve);
              $thumbnail_name = 'thumbnail_' . $var_id . date('Ymd') . time() . '.' . $thumbnail_info['extension'];
              $thumbnail_target = $this->mediaFolder('news_thumbnail') . $thumbnail_name;
              if (copy($thumbnail_reserve, $thumbnail_target)) {
                $this->model->updateData(array("table" => "news_tbl", "field" => array("news_img_thumbnail_path" => $thumbnail_name), "where" => " news_id='" . $var_id . "'"));
                @unlink($thumbnail_reserve);
                $this->model->deleteData(array("table" => "reserve_news_thumbnail", "where" => " user_id='" . $user_id . "'"));
              } //copy
            } //empty
          } //check_thumbnail
          $check_gallery = $this->model->getDataList(array("table" => "reserve_gallery", "field" => "gallery_id as id,gallery_title as title,gallery_path as img_src", "where" => " user_id='" . $user_id . "'", "sort_by" => "gallery_id ASC "));
          if (is_array($check_gallery)) {
            if (count($check_gallery) > 0) {
              $g = 1;
              foreach ($check_gallery as $gallery) {
                $gallery_reserve = $this->ReserveMediaFolder("gallery") . $gallery["img_src"];
                if (file_exists($gallery_reserve)) {
                  $gallery_insert = $this->model->insertData(array("table" => "gallery_tbl", "field" => array("gallery_title" => $gallery['title'], "news_id" => $var_id)));
                  if (!empty($gallery_insert)) {
                    $gallery_info = pathinfo($gallery_reserve);
                    $gallery_name = 'gallery_' . $var_id . $gallery_insert . 'T' . date('YmdHis') . '.' . $gallery_info['extension'];
                    $gallery_target = $this->mediaFolder('gallery') . $gallery_name;
                    if (copy($gallery_reserve, $gallery_target)) {
                      $gallery_update = $this->model->updateData(array("table" => "gallery_tbl", "field" => array("gallery_path" => $gallery_name), "where" => " gallery_id='" . $gallery_insert . "'"));
                      if ($gallery_update === true) {
                        @unlink($gallery_reserve);
                      } //gallery_update
                    } //copy
                  } //empty
                } //file_exists
                if ($g == count($check_gallery)) {
                  $this->model->deleteData(array("table" => "reserve_gallery", "where" => " user_id='" . $user_id . "'"));
                }
                $g++;
              } //foreach
            } //count
          } //check_gallery
          $check_files = $this->model->getDataList(array("table" => "reserve_news_files", "field" => "news_files_id as id,news_files_title as title,news_files_path as files_src", "where" => " user_id='" . $user_id . "'", "sort_by" => "news_files_id ASC "));
          if (is_array($check_files)) {
            if (count($check_files) > 0) {
              $f = 1;
              foreach ($check_files as $files) {
                $files_reserve = $this->ReserveFilesFolder("news") . $files["files_src"];
                if (file_exists($files_reserve)) {
                  $files_insert = $this->model->insertData(array("table" => "news_files_tbl", "field" => array("news_files_title" => $files['title'], "news_id" => $var_id)));
                  if (!empty($files_insert)) {
                    $files_info = pathinfo($files_reserve);
                    $files_name = 'files_' . $var_id . $files_insert . 'T' . date('YmdHis') . '.' . $files_info['extension'];
                    $files_target = $this->filesFolder('news') . $files_name;
                    if (copy($files_reserve, $files_target)) {
                      $files_update = $this->model->updateData(array("table" => "news_files_tbl", "field" => array("news_files_path" => $files_name), "where" => " news_files_id='" . $files_insert . "'"));
                      if ($files_update === true) {
                        @unlink($files_reserve);
                      } //files_update
                    } //copy
                  } //empty
                } //file_exists
                if ($f == count($check_files)) {
                  $this->model->deleteData(array("table" => "reserve_news_files", "where" => " user_id='" . $user_id . "'"));
                }
                $f++;
              } //foreach
            } //count
          } //check_files
          $go_url = $this->baseurl->backend->module->news->manage . $var_id;
          $this->xFunction->pageReload($this->lang->alert->save->success, $go_url);
        } else {
          $this->xFunction->cssAlert('error', $this->lang->alert->save->fail);
        } //empty insert
      } //action = create-news
      if ($_POST['action'] == 'update-news') {
        $user_id = $this->checkUID('id');
        $var_id = $_POST['id'];
        $check = $this->model->getData(array("table" => "news_tbl", "field" => "news_id as id,news_img_thumbnail_path as thumbnail,department_list", "where" => " news_id='" . $var_id . "' "));
        if (is_array($check) && !empty($check['id'])) {
          if ($_POST['del_images'] == 1) {
            @unlink($this->mediaFolder('news_thumbnail') . $check['thumbnail']);
            $this->model->updateData(array("table" => "news_tbl", "field" => array("news_img_thumbnail_path" => ''), "where" => " news_id='" . $var_id . "' "));
          }
          $var_category = $_POST['category'];
          $var_title = $this->xFunction->htmlspec($_POST['title'], 1);
          $var_overview = $this->xFunction->htmlspec($_POST['overview'], 1);
          $var_description = $this->xFunction->htmlspec($_POST['description'], 1);
          $var_youtube = urlencode($_POST['youtube']);
          if ($this->checkUID('level') == 9) {
            $var_sticky = $_POST['sticky'];
            $var_status = $_POST['status'];
          }
          $var_datestart = $this->xFunction->datetimeDB($_POST['news_start']);
          $var_dateend = $this->xFunction->datetimeDB($_POST['news_end']);
          $var_department = $_POST['department'];
          $check_value = '';
          if (!empty($check['department_list'])) {
            $check_department = $this->model->getData(array("table" => "news_tbl", "field" => "news_id as id", "where" => " news_id='" . $var_id . "' AND department_list='" . $var_department . "' "));
            if (is_array($check_department) && !empty($check_department['id'])) {
              $check_value = 0;
            } else {
              $check_value = 1;
            }
          } else {
            $check_value = 1;
          }
          if ($check_value == 1) {
            if (!empty($var_department)) {
              $exp_department = explode(',', $var_department);
              if (is_array($exp_department) && count($exp_department) > 0) {
                $delete = $this->model->deleteData(array("table" => "department_news_tbl", "where" => " news_id='" . $var_id . "' "));
                foreach ($exp_department as $key => $department) {
                  $this->model->insertData(array("table" => "department_news_tbl", "field" => array("news_id" => $var_id, "department_id" => $department)));
                }
              } //is_array
            } //empty >> department
          } //check_value
          if ($this->checkUID('level') == 9) {
            $update = $this->model->updateData(array("table" => "news_tbl", "field" => array("category_id" => $var_category, "department_list" => $var_department, "news_title" => $var_title, "news_overview" => $var_overview, "news_description" => $var_description, "news_youtube" => $var_youtube, "news_sticky" => $var_sticky, "news_datetime_start" => $var_datestart, "news_datetime_end" => $var_dateend, "news_status" => $var_status), "where" => " news_id='" . $var_id . "' "));
          } else {
            $update = $this->model->updateData(array("table" => "news_tbl", "field" => array("category_id" => $var_category, "department_list" => $var_department, "news_title" => $var_title, "news_overview" => $var_overview, "news_description" => $var_description, "news_youtube" => $var_youtube, "news_datetime_start" => $var_datestart, "news_datetime_end" => $var_dateend), "where" => " news_id='" . $var_id . "' "));
          }
          if ($update === true) {

            /*Save Log*/
            $log_note = 'รหัส : ' . $var_id . ' / หัวข้อ :' . $var_title;
            $this->model->insertData(array("table" => "website_log", "field" => array("user_id" => $user_id, "status" => 4, "note" => $log_note, "create_at" => date("Y-m-d H:i:s"))));
            /*Save Log*/

            $this->xFunction->pageReload($this->lang->alert->save->success);
          } else {
            $this->xFunction->cssAlert('error', $this->lang->alert->save->fail);
          }
        } //is_array
      } //action = update-news
      if ($_POST['action'] == 'change-status') {
        $user_id = $this->checkUID('id');
        $var_id = $_POST['news_id'];
        $check = $this->model->getData(array("table" => "news_tbl", "field" => "news_id as id,news_title as title,news_status as status", "where" => " news_id='" . $var_id . "' "));
        if (is_array($check) && !empty($check['id'])) {
          if ($check['status'] == '1') {
            $var_status = '0';
            /*Save Log*/
            $log_note = 'รหัส : ' . $var_id . ' / หัวข้อ :' . $this->xFunction->htmlspec($check['title']);
            $this->model->insertData(array("table" => "website_log", "field" => array("user_id" => $user_id, "status" => 7, "note" => $log_note, "create_at" => date("Y-m-d H:i:s"))));
            /*Save Log*/
          } else {
            $var_status = '1';
            /*Save Log*/
            $log_note = 'รหัส : ' . $var_id . ' / หัวข้อ :' . $this->xFunction->htmlspec($check['title']);
            $this->model->insertData(array("table" => "website_log", "field" => array("user_id" => $user_id, "status" => 6, "note" => $log_note, "create_at" => date("Y-m-d H:i:s"))));
            /*Save Log*/
          }
          $update = $this->model->updateData(array("table" => "news_tbl", "field" => array("news_status" => $var_status), "where" => " news_id='" . $var_id . "' "));
          if ($update === true) {
            $this->xFunction->pageReload($this->lang->alert->notify->status_success);
          } else {
            $this->xFunction->pageReload($this->lang->alert->notify->fail);
          }
        } else {
          $this->xFunction->cssAlert('fail', $this->lang->alert->notfound->id . ' ' . $var_id . '!');
        }
      } //action = change-status
      if ($_POST['action'] == 'save-thumbnail') {
        if (!empty($_POST['thumbnail'])) {
          $var_id = $_POST['id'];
          $check_thumbnail = $this->model->getData(array("table" => "news_tbl", "field" => "news_id as id,news_img_thumbnail_path as thumbnail", "where" => " news_id='" . $var_id . "' "));
          if (is_array($check_thumbnail) && !empty($check_thumbnail['thumbnail'])) {
            @unlink($this->mediaFolder('news_thumbnail') . $check_thumbnail['thumbnail']);
            $this->model->updateData(array("table" => "news_tbl", "field" => array("news_img_thumbnail_path" => ''), "where" => " news_id='" . $var_id . "' "));
          }
          $data = $_POST['thumbnail'];
          list($type, $data) = explode(';', $data);
          list(, $data) = explode(',', $data);
          $data = base64_decode($data);
          if ($type == 'data:image/png' || $type == 'data:image/jpeg') {
            $file_name = 'thumbnail_' . $var_id . date('Ymd') . time() . '.png';
            $upload = file_put_contents($this->mediaFolder('news_thumbnail') . $file_name, $data);
            if (!empty($upload)) {
              $update = $this->model->updateData(array("table" => "news_tbl", "field" => array("news_img_thumbnail_path" => $file_name), "where" => " news_id='" . $var_id . "' "));
              if ($update === true) {
                $this->xFunction->autoCLICK('eclose-modal');
                $this->xFunction->showIMG($this->mediaURL('news_thumbnail') . $file_name);
                $this->xFunction->hideHTML('.thumb_del');
              } else {
                $this->xFunction->sAlert($this->lang->alert->fail->proceed);
              }
            } else {
              $this->xFunction->sAlert($this->lang->alert->fail->proceed);
            }
          } else {
            $this->xFunction->sAlert($this->lang->alert->fail->proceed);
          } //check data:image/png
        } //check empty
      } //action = save-thumbnail
      if ($_POST['action'] == 'upload-gallery') {
        $var_id = $_POST['img_upload_id'];
        if ($_POST['image_form_submit'] == 1) {
          $no = 1;
          $check = 0;
          $import = 0;
          $check_img = count($_FILES['images']['name']);
          if ($check_img > 0) {
            foreach ($_FILES['images']['name'] as $key => $val) {
              $file_ext = strtolower(end(explode('.', $_FILES['images']['name'][$key])));
              $expensions = array("jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "gif", "GIF");
              $img_fail = '';
              if (in_array($file_ext, $expensions) === false) {
                $error_extension = $this->lang->alert->incorrect->img_extension_limit;
                $img_fail = 1;
              }
              if ($_FILES['images']['size'][$key] > 5242880) {
                $error_sizelimit = $this->lang->alert->incorrect->files_size_limit;
                $img_fail = 1;
              }
              if ($_FILES['images']['error'][$key] != true && empty($img_fail)) {
                $image_title = $this->xFunction->getNANE($_FILES['images']['name'][$key]);
                $insert_id = $this->model->insertData(array("table" => "gallery_tbl", "field" => array("gallery_title" => $image_title, "gallery_path" => '', "news_id" => $var_id)));
                if (!empty($insert_id)) {
                  $runtime = date("YmdHis");
                  $files_name = 'gallery_' . $var_id . $insert_id . 'T' . $runtime . '.' . $file_ext;
                  $img_src = $this->mediaFolder('gallery_original') . $files_name;
                  $img_traget = $this->mediaFolder('gallery') . $files_name;
                  chmod($_FILES['images']['tmp_name'][$key], 0755);
                  /*uploadIMG*/
                  $upload_img = $this->xFunction->uploadIMG($_FILES['images']['tmp_name'][$key], $img_src);
                  if ($upload_img === true) {
                    $this->xFunction->resizeIMG(1170, $img_traget, $img_src);
                    $this->model->updateData(array("table" => "gallery_tbl", "field" => array("gallery_path" => $files_name), "where" => " gallery_id='" . $insert_id . "' "));
                  } else {
                    $this->model->deleteData(array("table" => "gallery_tbl", "where" => " gallery_id='" . $insert_id . "' "));
                  }
                  /*uploadIMG*/
                  $import++;
                }
              } else {
                $upload_fail = '';
                $upload_fail .= $this->lang->label->files . ': ' . $_FILES['images']['name'][$key] . ' ' . $this->lang->alert->upload->fail . '\n';
                if (!empty($error_extension)) {
                  $upload_fail .= '- ' . $error_extension . '\n';
                }
                if (!empty($error_sizelimit)) {
                  $upload_fail .= '- ' . $error_sizelimit . '\n';
                }
                $this->xFunction->sAlert($upload_fail);
              } //check error
              $no++;
              $check++;
            } //foreach
          } //check count
          if ($check_img == $check && !empty($import)) {
            $addthis = '';
            $addthis .= ' load_gallery(' . $var_id . '); ';
            $addthis .= ' load_manage_gallery(' . $var_id . '); ';
            $addthis .= '$(\'#modal-images-manage\').modal(\'show\');';
            $addthis .= '$(\'#close-modal\').click();';
            $this->xFunction->sAlert($this->lang->alert->success->proceed, $addthis);
          }
        } //image_form_submit
      } //action = upload-gallery
      if ($_POST['action'] == 'update-gallery-title') {
        $var_id = $_POST['news_id'];
        $items_title = array();
        parse_str($_POST['items_title'], $items_title);
        if (is_array($items_title)) {
          $no = 1;
          if (count($items_title['gallery_title']) > 0) {
            foreach ($items_title['gallery_title'] as $keys => $values) {
              $this->model->updateData(array("table" => "gallery_tbl", "field" => array("gallery_title" => $values), "where" => " gallery_id='" . $keys . "' AND news_id='" . $var_id . "' "));
              if ($no == count($items_title['gallery_title'])) {
                $addthis = '';
                $addthis .= ' load_gallery(' . $var_id . '); ';
                $addthis .= ' load_manage_gallery(' . $var_id . '); ';
                $this->xFunction->sAlert($this->lang->alert->save->success, $addthis);
              }
              $no++;
            } //foreach
          }
        } //is_array
      } //action = update-gallery-title
      if ($_POST['action'] == 'select-gallery-del') {
        $var_id = $_POST['news_id'];
        $var_items = $_POST['items_list'];
        if (is_array($var_items)) {
          $items_array = array_values($var_items);
          $items_list = $this->xFunction->xEmpty($items_array);
          if (is_array($items_list)) {
            foreach ($items_list as $ekeys => $eval) {
              $check = $this->model->getData(array("table" => "gallery_tbl", "field" => "gallery_id as id,gallery_path as img_src", "where" => " gallery_id='" . $eval . "' AND news_id='" . $var_id . "' "));
              if (is_array($check) && !empty($check['id'])) {
                if (!empty($check['img_src'])) {
                  @unlink($this->mediaFolder('gallery') . $check['img_src']);
                }
              }
            } //foreach
          } //check items_list
          $dKeys = $this->xFunction->xDEL('gallery_id', $items_list);
          $delete = $this->model->deleteData(array("table" => "gallery_tbl", "where" => $dKeys));
          if ($delete === true) {
            $addthis = '';
            $addthis .= ' load_gallery(' . $var_id . '); ';
            $addthis .= ' load_manage_gallery(' . $var_id . '); ';
            $this->xFunction->sAlert($this->lang->alert->delete->success, $addthis);
          } else {
            $this->xFunction->cssAlert('fail', $this->lang->alert->delete->fail);
          }
        } //is_array
      } //action = select-gallery-del
      if ($_POST['action'] == 'upload-attachment') {
        $var_id = $_POST['files_upload_id'];
        if ($_POST['files_form_submit'] == 1) {
          $no = 1;
          $check = 0;
          $import = 0;
          $check_files = count($_FILES['files']['name']);
          if ($check_files > 0) {
            foreach ($_FILES['files']['name'] as $key => $val) {
              $file_ext = strtolower(end(explode('.', $_FILES['files']['name'][$key])));
              $expensions = array("pdf", "doc", "docx", "xls", "xlsx");
              $error = '';
              if (in_array($file_ext, $expensions) === false) {
                $error_extension = $this->lang->alert->incorrect->files_extensions_limit;
                $error = 1;
              }
              if ($_FILES['files']['size'][$key] > 5242880) {
                $error_sizelimit = $this->lang->alert->incorrect->files_size_limit;
                $error = 1;
              }
              if ($_FILES['files']['error'][$key] != true && empty($error)) {
                $files_title = $this->xFunction->getNANE($_FILES['files']['name'][$key]);
                $insert_id = $this->model->insertData(array("table" => "news_files_tbl", "field" => array("news_files_title" => $files_title, "news_files_path" => '', "news_id" => $var_id)));
                if (!empty($insert_id)) {
                  $runtime = date("YmdHis");
                  $files_name = 'files_' . $var_id . $insert_id . 'T' . $runtime . '.' . $file_ext;
                  $files_src = $this->filesFolder('news') . $files_name;
                  chmod($_FILES['files']['tmp_name'][$key], 0755);
                  /*uploadfiles*/
                  $upload_files = $this->xFunction->uploadIMG($_FILES['files']['tmp_name'][$key], $files_src);
                  if ($upload_files === true) {
                    $this->model->updateData(array("table" => "news_files_tbl", "field" => array("news_files_path" => $files_name), "where" => " news_files_id='" . $insert_id . "' "));
                  } else {
                    $this->model->deleteData(array("table" => "news_files_tbl", "where" => " news_files_id='" . $insert_id . "' "));
                  }
                  /*uploadfiles*/
                  $import++;
                }
              } else {
                $upload_fail = '';
                $upload_fail .= $this->lang->label->files . ': ' . $_FILES['files']['name'][$key] . ' ' . $this->lang->alert->upload->fail . '\n';
                if (!empty($error_extension)) {
                  $upload_fail .= '- ' . $error_extension . '\n';
                }
                if (!empty($error_sizelimit)) {
                  $upload_fail .= '- ' . $error_sizelimit . '\n';
                }
                $this->xFunction->sAlert($upload_fail);
              } //check error
              $no++;
              $check++;
            } //foreach
          } //check count
          if ($check_files == $check && !empty($import)) {
            $addthis = '';
            $addthis .= ' load_attachment(' . $var_id . '); ';
            $addthis .= ' load_manage_attachment(' . $var_id . '); ';
            $addthis .= '$(\'#modal-files-manage\').modal(\'show\');';
            $addthis .= '$(\'#fclose-modal\').click();';
            $this->xFunction->sAlert($this->lang->alert->success->proceed, $addthis);
          }
        } //files_form_submit
      } //action = upload-files
      if ($_POST['action'] == 'update-files-title') {
        $var_id = $_POST['news_id'];
        $items_title = array();
        parse_str($_POST['items_title'], $items_title);
        if (is_array($items_title)) {
          $no = 1;
          if (count($items_title['files_title']) > 0) {
            foreach ($items_title['files_title'] as $keys => $values) {
              $this->model->updateData(array("table" => "news_files_tbl", "field" => array("news_files_title" => $values), "where" => " news_files_id='" . $keys . "' AND news_id='" . $var_id . "' "));
              if ($no == count($items_title['files_title'])) {
                $addthis = '';
                $addthis .= ' load_attachment(' . $var_id . '); ';
                $addthis .= ' load_manage_attachment(' . $var_id . '); ';
                $this->xFunction->sAlert($this->lang->alert->save->success, $addthis);
              }
              $no++;
            } //foreach
          } //count
        } //is_array
      } //action = update-gallery-title
      if ($_POST['action'] == 'select-files-del') {
        $var_id = $_POST['news_id'];
        $var_items = $_POST['items_list'];
        if (is_array($var_items)) {
          $items_array = array_values($var_items);
          $items_list = $this->xFunction->xEmpty($items_array);
          if (is_array($items_list)) {
            foreach ($items_list as $ekeys => $eval) {
              $check = $this->model->getData(array("table" => "news_files_tbl", "field" => "news_files_id as id,news_files_path as files_src", "where" => " news_files_id='" . $eval . "' AND news_id='" . $var_id . "' "));
              if (is_array($check) && !empty($check['id'])) {
                if (!empty($check['files_src'])) {
                  @unlink($this->filesFolder('news') . $check['files_src']);
                }
              }
            } //foreach
          } //check items_list
          $dKeys = $this->xFunction->xDEL('news_files_id', $items_list);
          $delete = $this->model->deleteData(array("table" => "news_files_tbl", "where" => $dKeys));
          if ($delete === true) {
            $addthis = '';
            $addthis .= ' load_attachment(' . $var_id . '); ';
            $addthis .= ' load_manage_attachment(' . $var_id . '); ';
            $this->xFunction->sAlert($this->lang->alert->delete->success, $addthis);
          } else {
            $this->xFunction->cssAlert('fail', $this->lang->alert->delete->fail);
          }
        } //is_array
      } //action = select-files-del
      if ($_POST['action'] == 'upload-news-images') {
        $var_refresh = $_POST['refresh'];
        if ($_POST['news_images_submit'] == 1) {
          $no = 1;
          $check = 0;
          $import = 0;
          $check_img = count($_FILES['news_images']['name']);
          if ($check_img > 0) {
            foreach ($_FILES['news_images']['name'] as $key => $val) {
              $file_ext = strtolower(end(explode('.', $_FILES['news_images']['name'][$key])));
              $expensions = array("jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "gif", "GIF");
              $img_fail = '';
              if (in_array($file_ext, $expensions) === false) {
                $error_extension = $this->lang->alert->incorrect->img_extension_limit;
                $img_fail = 1;
              }
              if ($_FILES['news_images']['size'][$key] > 5242880) {
                $error_sizelimit = $this->lang->alert->incorrect->files_size_limit;
                $img_fail = 1;
              }
              if ($_FILES['news_images']['error'][$key] != true && empty($img_fail)) {
                $image_title = $this->xFunction->getNANE($_FILES['news_images']['name'][$key]);
                $insert_id = $this->model->insertData(array("table" => "news_img_tbl", "field" => array("news_img_title" => $image_title, "news_img_path" => '', "user_id" => $this->checkUID('id'))));
                if (!empty($insert_id)) {
                  $runtime = date("YmdHis");
                  $files_name = 'news_' . $insert_id . 'U' . $this->checkUID('id') . 'T' . $runtime . '.' . $file_ext;
                  $img_src = $this->mediaFolder('news_original') . $files_name;
                  $img_traget = $this->mediaFolder('news') . $files_name;
                  chmod($_FILES['news_images']['tmp_name'][$key], 0755);
                  /*uploadIMG*/
                  $upload_img = $this->xFunction->uploadIMG($_FILES['news_images']['tmp_name'][$key], $img_src);
                  if ($upload_img === true) {
                    $this->xFunction->resizeIMG(1170, $img_traget, $img_src);
                    $this->model->updateData(array("table" => "news_img_tbl", "field" => array("news_img_path" => $files_name), "where" => " news_img_id='" . $insert_id . "' "));
                  } else {
                    $this->model->deleteData(array("table" => "news_img_tbl", "where" => " news_img_id='" . $insert_id . "' "));
                  }
                  /*uploadIMG*/
                  $import++;
                }
              } else {
                $upload_fail = '';
                $upload_fail .= $this->lang->label->files . ': ' . $_FILES['news_images']['name'][$key] . ' ' . $this->lang->alert->upload->fail . '\n';
                if (!empty($error_extension)) {
                  $upload_fail .= '- ' . $error_extension . '\n';
                }
                if (!empty($error_sizelimit)) {
                  $upload_fail .= '- ' . $error_sizelimit . '\n';
                }
                $this->xFunction->sAlert($upload_fail);
              } //check error
              $no++;
              $check++;
            } //foreach
          } //check count
          if ($check_img == $check && !empty($import)) {
            if (empty($var_refresh)) {
              $addthis = '';
              $addthis .= ' load_news_images(); ';
              $this->xFunction->sAlert($this->lang->alert->success->proceed, $addthis);
            } else {
              $this->xFunction->pageReload($this->lang->alert->success->proceed);
            }
          }
        } //image_form_submit
      } //action = upload-news-images
      if ($_POST['action'] == 'edit-images-title') {
        $var_id = $_POST['images_id'];
        $var_name = $_POST['images_name'];
        $var_refresh = $_POST['refresh'];
        $add_where = '';
        if ($this->checkUID('level') == 9 || $this->checkUID('level') == 8) {
          $add_where .= '';
        } else {
          $user_id = $this->checkUID('id');
          $add_where .= " AND user_id='" . $user_id . "'";
        }
        if (!empty($var_id)) {
          $check = $this->model->getData(array("table" => "news_img_tbl", "field" => "news_img_id as id", "where" => " news_img_id='" . $var_id . "'" . $add_where));
          if (is_array($check) && !empty($check['id'])) {
            $update = $this->model->updateData(array("table" => "news_img_tbl", "field" => array("news_img_title" => $var_name), "where" => " news_img_id='" . $var_id . "' "));
            if ($update === true) {
              if (empty($var_refresh)) {
                $addthis = '';
                $addthis .= ' load_news_images(); ';
                $addthis .= ' load_form_images(' . $var_id . '); ';
                $this->xFunction->sAlert($this->lang->alert->success->proceed, $addthis);
              } else {
                $this->xFunction->pageReload($this->lang->alert->success->proceed);
              }
            } else {
              $this->xFunction->sAlert($this->lang->alert->fail->proceed);
            }
          } //is_array
        } //empty
      } //action = edit-images-title
      if ($_POST['action'] == 'single-images-delete') {
        $var_id = $_POST['images_id'];
        $var_refresh = $_POST['refresh'];
        $add_where = '';
        if ($this->checkUID('level') == 9) {
          $add_where .= '';
        } else {
          $user_id = $this->checkUID('id');
          $add_where .= " AND user_id='" . $user_id . "'";
        }
        if (!empty($var_id)) {
          $check = $this->model->getData(array("table" => "news_img_tbl", "field" => "news_img_id as id,news_img_path as img_src", "where" => " news_img_id='" . $var_id . "'" . $add_where));
          if (is_array($check) && !empty($check['id'])) {
            if (!empty($check['img_src'])) {
              @unlink($this->mediaFolder('news') . $check['img_src']);
            }
            $delete = $this->model->deleteData(array("table" => "news_img_tbl", "where" => " news_img_id='" . $var_id . "' "));
            if ($delete === true) {
              if (empty($var_refresh)) {
                $this->xFunction->autoCLICK('xclose-modal');
                $addthis = '';
                $addthis .= ' load_news_images(); ';
                $this->xFunction->sAlert($this->lang->alert->delete->success, $addthis);
              } else {
                $this->xFunction->pageReload($this->lang->alert->delete->success);
              }
            } else {
              $this->xFunction->cssAlert('fail', $this->lang->alert->delete->fail);
            }
          } //is_array
        } //empty
      } //action = single-images-delete
      if ($_POST['action'] == 'select-del') {
        $var_items = $_POST['items_list'];
        $add_where = '';
        if ($this->checkUID('level') == 9) {
          $add_where .= '';
        } else {
          $user_id = $this->checkUID('id');
          $add_where .= " AND user_id='" . $user_id . "'";
        }
        if (is_array($var_items)) {
          $items_array = array_values($var_items);
          $items_list = $this->xFunction->xEmpty($items_array);
          if (is_array($items_list)) {
            $no = 1;
            foreach ($items_list as $ekeys => $eval) {
              $check_news = $this->model->getData(array("table" => "news_tbl", "field" => "news_id as id,news_title as title,news_img_thumbnail_path as img_src", "where" => " news_id='" . $eval . "'" . $add_where));
              if (is_array($check_news) && !empty($check_news['id'])) {

                /*Save Log*/
                $log_note = 'รหัส : ' . $eval . ' / หัวข้อ :' . $this->xFunction->htmlspec($check_news['title']);
                $this->model->insertData(array("table" => "website_log", "field" => array("user_id" => $this->checkUID('id'), "status" => 5, "note" => $log_note, "create_at" => date("Y-m-d H:i:s"))));
                /*Save Log*/

                if (!empty($check_news['img_src'])) {
                  @unlink($this->mediaFolder('news_thumbnail') . $check_news['img_src']);
                }
                $check_gallery = $this->model->getDataList(array("table" => "gallery_tbl", "field" => "gallery_id as id,gallery_path as img_src", "where" => " news_id='" . $check_news['id'] . "'", "sort_by" => "gallery_id ASC "));
                if (is_array($check_gallery)) {
                  $a = 1;
                  foreach ($check_gallery as $gallery) {
                    if (!empty($gallery['img_src'])) {
                      @unlink($this->mediaFolder('gallery') . $gallery['img_src']);
                    }
                    if (count($check_gallery) == $a) {
                      $this->model->deleteData(array("table" => "gallery_tbl", "where" => " news_id='" . $check_news['id'] . "' "));
                    }
                    $a++;
                  }
                } //check_thumbnail
                $check_attachment = $this->model->getDataList(array("table" => "news_files_tbl", "field" => "news_files_id as id,news_files_path as files_src", "where" => " news_id='" . $check_news['id'] . "'", "sort_by" => "news_files_id ASC "));
                if (is_array($check_attachment)) {
                  $b = 1;
                  foreach ($check_attachment as $attachment) {
                    if (!empty($attachment['files_src'])) {
                      @unlink($this->filesFolder('news') . $attachment['files_src']);
                    }
                    if (count($check_attachment) == $b) {
                      $this->model->deleteData(array("table" => "news_files_tbl", "where" => " news_id='" . $check_news['id'] . "' "));
                    }
                    $b++;
                  }
                } //check_attachment
                $this->model->deleteData(array("table" => "department_news_tbl", "where" => " news_id='" . $check_news['id'] . "' ")); //delete department + news
                $this->model->deleteData(array("table" => "news_tbl", "where" => " news_id='" . $check_news['id'] . "'" . $add_where));
              } //check_news
              if ($no == count($items_list)) {
                $this->xFunction->pageReload($this->lang->alert->delete->success);
              }
              $no++;
            } //foreach
          } //check items_list
        } //is_array
      } //action = select-del
      if ($_POST['action'] == 'select-images-del') {
        $var_items = $_POST['items_list'];
        $add_where = '';
        if ($this->checkUID('level') == 9) {
          $add_where .= '';
        } else {
          $user_id = $this->checkUID('id');
          $add_where .= " AND user_id='" . $user_id . "'";
        }
        if (is_array($var_items)) {
          $items_array = array_values($var_items);
          $items_list = $this->xFunction->xEmpty($items_array);
          if (is_array($items_list)) {
            $i = 1;
            foreach ($items_list as $ekeys => $eval) {
              $check = $this->model->getData(array("table" => "news_img_tbl", "field" => "news_img_id as id,news_img_path as img_src", "where" => " news_img_id='" . $eval . "'" . $add_where));
              if (is_array($check) && !empty($check['id'])) {
                if (!empty($check['img_src'])) {
                  @unlink($this->mediaFolder('news') . $check['img_src']);
                  $this->model->deleteData(array("table" => "news_img_tbl", "where" => " news_img_id='" . $eval . "'" . $add_where));
                }
              }
              if ($i == count($items_list)) {
                $this->xFunction->pageReload($this->lang->alert->delete->success);
              }
              $i++;
            } //foreach
          } //check items_list
        } //is_array
      } //action = select-images-del
    } //isset
  }
  public function loadMODERATOR()
  {
    if (isset($_POST['load']) && !empty($_POST['load'])) {
      if ($_POST['load'] == 'department') {
        $var_id = $_POST['id'];
        $check = $this->model->getData(array("table" => "department_tbl", "field" => "department_id as id,department_name as name", "where" => " department_id='" . $var_id . "'"));
        if (is_array($check) && !empty($check['id'])) {
          $form_html = '';
          $form_html .= '<div class="form-group">';
          $form_html .= '<label class="col-xs-12" >' . $this->lang->label->id . '</label>';
          $form_html .= '<div class="col-xs-12"><input  type="text" id="eid" name="eid" class="form-control" value="' . $check['id'] . '" readonly="readonly" required="" /></div>';
          $form_html .= '</div>';
          $form_html .= '<div class="form-group">';
          $form_html .= '<label class="col-xs-12" >' . $this->lang->label->name . '</label>';
          $form_html .= '<div class="col-xs-12"><input  type="text" id="ename" name="ename" class="form-control"  value="' . $check['name'] . '" required="" /></div>';
          $form_html .= '</div>';
          echo $form_html;
        }
      } //department
      if ($_POST['load'] == 'newstype') {
        $var_id = $_POST['id'];
        $check = $this->model->getData(array("table" => "category_tbl", "field" => "category_id as id,category_name as name", "where" => " category_id='" . $var_id . "'"));
        if (is_array($check) && !empty($check['id'])) {
          $form_html = '';
          $form_html .= '<div class="form-group">';
          $form_html .= '<label class="col-xs-12" >' . $this->lang->label->id . '</label>';
          $form_html .= '<div class="col-xs-12"><input  type="text" id="eid" name="eid" class="form-control" value="' . $check['id'] . '" readonly="readonly" required="" /></div>';
          $form_html .= '</div>';
          $form_html .= '<div class="form-group">';
          $form_html .= '<label class="col-xs-12" >' . $this->lang->label->name . '</label>';
          $form_html .= '<div class="col-xs-12"><input  type="text" id="ename" name="ename" class="form-control"  value="' . $check['name'] . '" required="" /></div>';
          $form_html .= '</div>';
          echo $form_html;
        }
      } //newstype
    } //isset
  } //loadMODERATOR
  public function loadNEWS()
  {
    if (isset($_POST['load']) && !empty($_POST['load'])) {
      if ($_POST['load'] == 'reserve-load-gallery') {
        $user_id = $this->checkUID('id');
        $galleryList = $this->model->getDataList(array("table" => "reserve_gallery", "field" => "gallery_id as id,gallery_title as title,gallery_path as img_src", "where" => " user_id='" . $user_id . "'", "sort_by" => "gallery_id ASC "));
        if (is_array($galleryList)) {
          foreach ($galleryList as $gallery) {
            $img_src = $this->ReserveMediaURL("gallery") . $gallery["img_src"];
            echo '<li class="center">';
            echo '<a href="' . $img_src . '" title="' . $gallery["title"] . '"><img src="' . $img_src . '" /></a>';
            echo '</li>';
          }
        } //is_array
      } // load = reserve-load-gallery
      if ($_POST['load'] == 'reserve-manage-gallery') {
        $user_id = $this->checkUID('id');
        $galleryList = $this->model->getDataList(array("table" => "reserve_gallery", "field" => "gallery_id as id,gallery_title as title,gallery_path as img_src", "where" => " user_id='" . $user_id . "'", "sort_by" => "gallery_id ASC "));
        $table = '';
        $table .= '<table class="table table-bordered table-striped" id="no-more-tables">';
        $table .= '<thead>';
        $table .= '<tr>';
        $table .= '<th width="10%" class="center">' . $this->lang->label->id . '</th>';
        $table .= '<th width="25%" class="center">' . $this->lang->label->images . '</th>';
        $table .= '<th width="55%">' . $this->lang->label->name . '</th>';
        $table .= '<th width="10%" class="center"><label class="pos-rel"><input type="checkbox" class="select_del" id="checkall" /><span class="lbl"></span> </label></th>';
        $table .= '</tr>';
        $table .= '</thead>';
        $table .= '<tbody>';
        if (is_array($galleryList)) {
          foreach ($galleryList as $gallery) {
            $gallery_src = $this->ReserveMediaURL("gallery") . $gallery["img_src"];
            $table .= '<tr>';
            $table .= '<td  class="center" data-title="' . $this->lang->label->id . '">' . $gallery['id'] . '</td>';
            $table .= '<td  class="center" data-title="' . $this->lang->label->images . '"><img src="' . $gallery_src . '" width="80" /></td>';
            $table .= '<td  data-title="' . $this->lang->label->name . '"><input type="text" id="gallery_title_' . $gallery['id'] . '" name="gallery_title[' . $gallery['id'] . ']" value="' . $gallery['title'] . '" class="get_title form-control" required="" /></td>';
            $table .= '<td  class="center" data-title="' . $this->lang->label->delete . '"><label class="pos-rel"><input id="id_' . $gallery['id'] . '" name="items" value="' . $gallery['id'] . '" type="checkbox" class="select_del" /><span class="lbl"></span></label></td>';
            $table .= '</tr>';
          }
        } else {
          $table .= '<tr><td colspan="4" class="center">' . $this->lang->alert->notfound->data . '</td></tr>';
        }
        $table .= '</tbody>';
        $table .= '</table>';
        $script = '';
        $script .= '<script type="text/javascript">';
        $script .= '$(document).ready(function () {';
        $script .= 'var $allCheckBoxes = $(\'input[class="select_del"]\').not(\'#checkall\');';
        $script .= 'var $checkAllTrigger = $(\'#checkall\');';
        $script .= 'var allCheckBoxesLength = $allCheckBoxes;';
        $script .= '$checkAllTrigger.on(\'click\', function () {';
        $script .= '$allCheckBoxes.prop(\'checked\', this.checked);';
        $script .= '})';
        $script .= '.blur();';
        $script .= '$allCheckBoxes.on(\'change\', function(){';
        $script .= '$checkAllTrigger.prop(\'checked\', allCheckBoxesLength == $allCheckBoxes.filter(":checked").length);';
        $script .= '});';
        $script .= '});';
        $script .= '</script>';
        echo $table . $script;
      } // load = reserve-manage-gallery
      if ($_POST['load'] == 'load-reserve-attachment') {
        $user_id = $this->checkUID('id');
        $filesList = $this->model->getDataList(array("table" => "reserve_news_files", "field" => "news_files_id as id,news_files_title as title,news_files_path as files_src", "where" => " user_id='" . $user_id . "'", "sort_by" => "news_files_id ASC "));
        if (is_array($filesList)) {
          foreach ($filesList as $attachment) {
            $attachment_src = $this->ReserveFilesURL("news") . $attachment["files_src"];
            echo '<li>';
            echo '<a href="' . $attachment_src . '" title="' . $attachment["title"] . '">' . $attachment["files_src"] . '</a>';
            echo '</li>';
          }
        } //is_array
      } // load = news-attachment
      if ($_POST['load'] == 'manage-reserve-attachment') {
        $user_id = $this->checkUID('id');
        $filesList = $this->model->getDataList(array("table" => "reserve_news_files", "field" => "news_files_id as id,news_files_title as title,news_files_path as files_src", "where" => " user_id='" . $user_id . "'", "sort_by" => "news_files_id ASC "));
        $table = '';
        $table .= '<table class="table table-bordered table-striped" id="two-more-tables">';
        $table .= '<thead>';
        $table .= '<tr>';
        $table .= '<th width="10%" class="center">' . $this->lang->label->id . '</th>';
        $table .= '<th width="25%" class="center">' . $this->lang->label->files . '</th>';
        $table .= '<th width="55%">' . $this->lang->label->name . '</th>';
        $table .= '<th width="10%" class="center"><label class="pos-rel"><input type="checkbox" class="select_files_del" id="files_checkall" /><span class="lbl"></span> </label></th>';
        $table .= '</tr>';
        $table .= '</thead>';
        $table .= '<tbody>';
        if (is_array($filesList)) {
          foreach ($filesList as $allfiles) {
            $allfiles_src = $this->ReserveFilesURL("news") . $allfiles["files_src"];
            $table .= '<tr>';
            $table .= '<td  class="center" data-title="' . $this->lang->label->id . '">' . $allfiles['id'] . '</td>';
            $table .= '<td  data-title="' . $this->lang->label->files . '"><a href="' . $allfiles_src . '">' . $allfiles["files_src"] . '</a></td>';
            $table .= '<td  data-title="' . $this->lang->label->name . '"><input type="text" id="files_title_' . $allfiles['id'] . '" name="files_title[' . $allfiles['id'] . ']" value="' . $allfiles['title'] . '" class="get_files_title form-control" required="" /></td>';
            $table .= '<td  class="center" data-title="' . $this->lang->label->delete . '"><label class="pos-rel"><input id="files_id_' . $allfiles['id'] . '" name="files_items" value="' . $allfiles['id'] . '" type="checkbox" class="select_files_del" /><span class="lbl"></span></label></td>';
            $table .= '</tr>';
          }
        } else {
          $table .= '<tr><td colspan="4" class="center">' . $this->lang->alert->notfound->data . '</td></tr>';
        }
        $table .= '</tbody>';
        $table .= '</table>';
        $script = '';
        $script .= '<script type="text/javascript">';
        $script .= '$(document).ready(function () {';
        $script .= 'var $filesallCheckBoxes = $(\'input[class="select_files_del"]\').not(\'#files_checkall\');';
        $script .= 'var $filescheckAllTrigger = $(\'#files_checkall\');';
        $script .= 'var filesallCheckBoxesLength = $filesallCheckBoxes;';
        $script .= '$filescheckAllTrigger.on(\'click\', function () {';
        $script .= '$filesallCheckBoxes.prop(\'checked\', this.checked);';
        $script .= '})';
        $script .= '.blur();';
        $script .= '$filesallCheckBoxes.on(\'change\', function(){';
        $script .= '$filescheckAllTrigger.prop(\'checked\', filesallCheckBoxesLength == $filesallCheckBoxes.filter(":checked").length);';
        $script .= '});';
        $script .= '});';
        $script .= '</script>';
        echo $table . $script;
      } // load = manage-reserve-attachment
      if ($_POST['load'] == 'load-gallery') {
        $var_id = $_POST['news_id'];
        if (!empty($var_id)) {
          $galleryList = $this->model->getDataList(array("table" => "gallery_tbl", "field" => "gallery_id as id,gallery_title as title,gallery_path as img_src", "where" => " news_id='" . $var_id . "'", "sort_by" => "gallery_id ASC "));
          if (is_array($galleryList)) {
            foreach ($galleryList as $gallery) {
              $img_src = $this->mediaURL("gallery") . $gallery["img_src"];
              echo '<li class="center">';
              echo '<a href="' . $img_src . '" title="' . $gallery["title"] . '"><img src="' . $img_src . '" /></a>';
              echo '</li>';
            }
          } //is_array
        } //empty
      } // load = news-gallery
      if ($_POST['load'] == 'manage-gallery') {
        $var_id = $_POST['news_id'];
        if (!empty($var_id)) {
          $galleryList = $this->model->getDataList(array("table" => "gallery_tbl", "field" => "gallery_id as id,gallery_title as title,gallery_path as img_src", "where" => " news_id='" . $var_id . "'", "sort_by" => "gallery_id ASC "));
          $table = '';
          $table .= '<table class="table table-bordered table-striped" id="no-more-tables">';
          $table .= '<thead>';
          $table .= '<tr>';
          $table .= '<th width="10%" class="center">' . $this->lang->label->id . '</th>';
          $table .= '<th width="25%" class="center">' . $this->lang->label->images . '</th>';
          $table .= '<th width="55%">' . $this->lang->label->name . '</th>';
          $table .= '<th width="10%" class="center"><label class="pos-rel"><input type="checkbox" class="select_del" id="checkall" /><span class="lbl"></span> </label></th>';
          $table .= '</tr>';
          $table .= '</thead>';
          $table .= '<tbody>';
          if (is_array($galleryList)) {
            foreach ($galleryList as $gallery) {
              $gallery_src = $this->mediaURL("gallery") . $gallery["img_src"];
              $table .= '<tr>';
              $table .= '<td  class="center" data-title="' . $this->lang->label->id . '">' . $gallery['id'] . '</td>';
              $table .= '<td  class="center" data-title="' . $this->lang->label->images . '"><img src="' . $gallery_src . '" width="80" /></td>';
              $table .= '<td  data-title="' . $this->lang->label->name . '"><input type="text" id="gallery_title_' . $gallery['id'] . '" name="gallery_title[' . $gallery['id'] . ']" value="' . $gallery['title'] . '" class="get_title form-control" required="" /></td>';
              $table .= '<td  class="center" data-title="' . $this->lang->label->delete . '"><label class="pos-rel"><input id="id_' . $gallery['id'] . '" name="items" value="' . $gallery['id'] . '" type="checkbox" class="select_del" /><span class="lbl"></span></label></td>';
              $table .= '</tr>';
            }
          } else {
            $table .= '<tr><td colspan="4" class="center">' . $this->lang->alert->notfound->data . '</td></tr>';
          }
          $table .= '</tbody>';
          $table .= '</table>';
          $script = '';
          $script .= '<script type="text/javascript">';
          $script .= '$(document).ready(function () {';
          $script .= 'var $allCheckBoxes = $(\'input[class="select_del"]\').not(\'#checkall\');';
          $script .= 'var $checkAllTrigger = $(\'#checkall\');';
          $script .= 'var allCheckBoxesLength = $allCheckBoxes;';
          $script .= '$checkAllTrigger.on(\'click\', function () {';
          $script .= '$allCheckBoxes.prop(\'checked\', this.checked);';
          $script .= '})';
          $script .= '.blur();';
          $script .= '$allCheckBoxes.on(\'change\', function(){';
          $script .= '$checkAllTrigger.prop(\'checked\', allCheckBoxesLength == $allCheckBoxes.filter(":checked").length);';
          $script .= '});';
          $script .= '});';
          $script .= '</script>';
          echo $table . $script;
        } //empty
      } // load = manage-gallery
      if ($_POST['load'] == 'load-attachment') {
        $var_id = $_POST['news_id'];
        if (!empty($var_id)) {
          $filesList = $this->model->getDataList(array("table" => "news_files_tbl", "field" => "news_files_id as id,news_files_title as title,news_files_path as files_src", "where" => " news_id='" . $var_id . "'", "sort_by" => "news_files_id ASC "));
          if (is_array($filesList)) {
            foreach ($filesList as $attachment) {
              $attachment_src = $this->filesURL("news") . $attachment["files_src"];
              echo '<li>';
              echo '<a href="' . $attachment_src . '" title="' . $attachment["title"] . '">' . $attachment["files_src"] . '</a>';
              echo '</li>';
            }
          } //is_array
        } //empty
      } // load = news-attachment
      if ($_POST['load'] == 'manage-attachment') {
        $var_id = $_POST['news_id'];
        if (!empty($var_id)) {
          $filesList = $this->model->getDataList(array("table" => "news_files_tbl", "field" => "news_files_id as id,news_files_title as title,news_files_path as files_src", "where" => " news_id='" . $var_id . "'", "sort_by" => "news_files_id ASC "));
          $table = '';
          $table .= '<table class="table table-bordered table-striped" id="two-more-tables">';
          $table .= '<thead>';
          $table .= '<tr>';
          $table .= '<th width="10%" class="center">' . $this->lang->label->id . '</th>';
          $table .= '<th width="25%" class="center">' . $this->lang->label->files . '</th>';
          $table .= '<th width="55%">' . $this->lang->label->name . '</th>';
          $table .= '<th width="10%" class="center"><label class="pos-rel"><input type="checkbox" class="select_files_del" id="files_checkall" /><span class="lbl"></span> </label></th>';
          $table .= '</tr>';
          $table .= '</thead>';
          $table .= '<tbody>';
          if (is_array($filesList)) {
            foreach ($filesList as $allfiles) {
              $allfiles_src = $this->filesURL("news") . $allfiles["files_src"];
              $table .= '<tr>';
              $table .= '<td  class="center" data-title="' . $this->lang->label->id . '">' . $allfiles['id'] . '</td>';
              $table .= '<td  data-title="' . $this->lang->label->files . '"><a href="' . $allfiles_src . '">' . $allfiles["files_src"] . '</a></td>';
              $table .= '<td  data-title="' . $this->lang->label->name . '"><input type="text" id="files_title_' . $allfiles['id'] . '" name="files_title[' . $allfiles['id'] . ']" value="' . $allfiles['title'] . '" class="get_files_title form-control" required="" /></td>';
              $table .= '<td  class="center" data-title="' . $this->lang->label->delete . '"><label class="pos-rel"><input id="files_id_' . $allfiles['id'] . '" name="files_items" value="' . $allfiles['id'] . '" type="checkbox" class="select_files_del" /><span class="lbl"></span></label></td>';
              $table .= '</tr>';
            }
          } else {
            $table .= '<tr><td colspan="4" class="center">' . $this->lang->alert->notfound->data . '</td></tr>';
          }
          $table .= '</tbody>';
          $table .= '</table>';
          $script = '';
          $script .= '<script type="text/javascript">';
          $script .= '$(document).ready(function () {';
          $script .= 'var $filesallCheckBoxes = $(\'input[class="select_files_del"]\').not(\'#files_checkall\');';
          $script .= 'var $filescheckAllTrigger = $(\'#files_checkall\');';
          $script .= 'var filesallCheckBoxesLength = $filesallCheckBoxes;';
          $script .= '$filescheckAllTrigger.on(\'click\', function () {';
          $script .= '$filesallCheckBoxes.prop(\'checked\', this.checked);';
          $script .= '})';
          $script .= '.blur();';
          $script .= '$filesallCheckBoxes.on(\'change\', function(){';
          $script .= '$filescheckAllTrigger.prop(\'checked\', filesallCheckBoxesLength == $filesallCheckBoxes.filter(":checked").length);';
          $script .= '});';
          $script .= '});';
          $script .= '</script>';
          echo $table . $script;
        } //empty
      } // load = manage-attachment
      if ($_POST['load'] == 'load-news-images') {
        $imagesList = $this->model->getDataList(array("table" => "news_img_tbl", "field" => "news_img_id as id,news_img_title as title,news_img_path as img_src", "where" => "  user_id='" . $this->checkUID('id') . "'", "sort_by" => "news_img_id DESC "));
        if (is_array($imagesList)) {
          foreach ($imagesList as $images) {
            $img_src = $this->mediaURL("news") . $images["img_src"];
            echo '<li class="center">';
            echo '<a href="#modal-open-images" id="images_copy_' . $images['id'] . '" data-toggle="modal" onclick="load_form_images(' . $images["id"] . ')" title="' . $images["title"] . '"><img src="' . $img_src . '" /></a>';
            echo '<span class="copy in_span" data-clipboard-action="copy" data-clipboard-text="' . $img_src . '" title="' . $this->lang->action->btn_copy . '"><i class="fa fa-copy blue"></i> ' . $this->lang->action->btn_copy . '</span>';
            echo '</li>';
          }
        } //is_array
      } // load = load-news-images
      if ($_POST['load'] == 'form-news-images') {
        $var_id = $_POST['images_id'];
        $add_where = '';
        if ($this->checkUID('level') == 9 || $this->checkUID('level') == 8) {
          $add_where .= '';
        } else {
          $user_id = $this->checkUID('id');
          $add_where .= " AND user_id='" . $user_id . "'";
        }
        if (!empty($var_id)) {
          $images = $this->model->getData(array("table" => "news_img_tbl", "field" => "user_id,news_img_id as id,news_img_title as title,news_img_path as img_src", "where" => " news_img_id='" . $var_id . "'" . $add_where));
          if (is_array($images) && !empty($images['id'])) {
            $img_src = $this->mediaURL("news") . $images["img_src"];
            $form_images = '';
            $form_images .= '<div class="form-group">';
            $form_images .= '<label class="col-xs-12 center">' . $this->lang->label->images . '</label>';
            $form_images .= '<div class="col-xs-12 center"><img src="' . $img_src . '" width="200" title="' . $images['title'] . '" class="images_border" data-lity /><br />';
            if ($this->checkUID('level') == 9) {
              $form_images .= '<a class="confirm-images-delete" id="delete_loading" href="javascript:void(0)"><i class="ace-icon fa fa-trash"></i> ' . $this->lang->button->delete . '</a>';
            } else {
              if ($images["user_id"] == $this->checkUID('id')) {
                $form_images .= '<a class="confirm-images-delete" id="delete_loading" href="javascript:void(0)"><i class="ace-icon fa fa-trash"></i> ' . $this->lang->button->delete . '</a>';
              }
            }
            $form_images .= '</div></div>';
            $form_images .= '<div class="form-group">';
            $form_images .= '<label class="col-xs-12">' . $this->lang->label->id . '</label>';
            $form_images .= '<div class="col-xs-12"><input type="text" id="images_id" name="images_id" class="form-control" value="' . $images['id'] . '" readonly /></div>';
            $form_images .= '</div>';
            $form_images .= '<div class="form-group">';
            $form_images .= '<label class="col-xs-12">' . $this->lang->label->name . '</label>';
            $form_images .= '<div class="col-xs-12">';
            $form_images .= '<div class="input-group">';
            $form_images .= '<input type="text" id="images_name" name="images_name" value="' . $images['title'] . '" class="form-control" />';
            $form_images .= '<span class="input-group-addon in_span" id="load_images_title" onclick="edit_images_title()">';
            $form_images .= '<i class="fa fa-edit bigger-110"></i> ' . $this->lang->action->edit;
            $form_images .= '</span></div></div></div>';
            $form_images .= '<div class="form-group">';
            $form_images .= '<label class="col-xs-12">' . $this->lang->label->link_url . '</label>';
            $form_images .= '<div class="col-xs-12">';
            $form_images .= '<div class="input-group">';
            $form_images .= '<input type="text" id="images_link" name="images_link" class="form-control" value="' . $img_src . '" onfocus="this.select()" />';
            $form_images .= '<span class="copy input-group-addon in_span" data-clipboard-action="copy" data-clipboard-target="input#images_link">';
            $form_images .= '<i class="fa fa-copy bigger-110"></i> ' . $this->lang->action->btn_copy;
            $form_images .= '</span></div></div></div><!--form-group-->';
            echo $form_images;
          }
        }
      } // load = form-news-images
    } //isset
  }
  /*NEWS*/
} //Controller
