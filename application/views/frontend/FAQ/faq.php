<style type="text/css">
#owl-demo .item img{
display: block;
width: 100%;
height: auto;
}
.faqHeader {
    font-size: 27px;
    margin: 20px;
}
.panel-heading [data-toggle="collapse"]:after {
font: normal normal normal 14px/1 FontAwesome;
    content:"\f0da";
    float: right;
    color: #F58723;
    font-size: 18px;
    line-height: 22px;
    -webkit-transform: rotate(-90deg);
    -moz-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    -o-transform: rotate(-90deg);
    transform: rotate(-90deg);
}
.panel-heading [data-toggle="collapse"].collapsed:after {
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    transform: rotate(90deg);
    color: #454444;
}
</style>
<?php $this->load->view('include/header_css');?>
<body>
    <header class="navigation">
        <div class="top-bar">
            <?php $this->load->view('include/top_header'); //include('include/top_header.php');?>
        </div>
        
        <nav class="navbar">
            <?php $this->load->view('include/nav_header.php'); ?>
        </nav>
    </header>
    <div class="wrapper event-wrap">
        <div class="container">
            <div class="cntct-header">
                <div class="row">
                    <div class="col-sm-9 acordin">
                        <div class="page-header">
                            <h3>FAQ</h3>
                            <p>Frequently Asked Questions</p>
                        </div>

                        <div class="panel-group" id="accordion">
                            <?php if(isset($faqList)) {
                            foreach ($faqList as $faq) { ?>                    
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven<?php if(isset($faq->faq_id)) {echo $faq->faq_id; }?>"><?php if(isset($faq->faq_que)) {echo $faq->faq_que; }?></a>
                                    </h4>
                                </div>
                                <div id="collapseSeven<?php if(isset($faq->faq_id)) {echo $faq->faq_id; }?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <?php if(isset($faq->faq_ans)) {echo $faq->faq_ans; }?>
                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="cms-ads" >
                        <div class="google-ad" >
                        <?php $googleAds = $this->model->get_row('tbl_google_ads',array('pagename'=>'CMS Pages'));
                        ?>
                        <style>
                        .example_responsive_1 { width: 160px !important; height: 600px !important; }
                        </style>
                        <script async src="<?php if(isset($googleAds->script_url)){ echo $googleAds->script_url; }else{echo '//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js';} ?>"></script>
                        <ins class="adsbygoogle example_responsive_1"
                        style="display:inline-block"
                        data-ad-client="<?php if(isset($googleAds->google_ad_client)){ echo $googleAds->google_ad_client; }else{echo 'ca-pub-2773616400896769';} ?>"
                        data-ad-slot="<?php if(isset($googleAds->slot_id)){ echo $googleAds->slot_id; }else{echo '3977017541';} ?>"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                        </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
    
    <footer class="main_footer">
        <?php $this->load->view('include/main_footer.php'); ?>
    </footer>
    <div class="copy-right">
        <?php $this->load->view('include/copyright.php'); ?>
    </div>
</body>
</html>