<?php if(isset($eventList)){
// print_r($eventList);
foreach ($eventList as $events) {
$words = explode(" ",$events->event_description);
$content = implode(" ",array_splice($words,0,30));
$words1 = explode(" ",$events->event_title);
$content1 = implode(" ",array_splice($words1,0,4));
?>
<div class="col-sm-4 col-md-3 col-lg-3 event">
    <div class="mnm-sub-sec">
        <div class="mnm-sub-img">
            <div id="event-slider" class="event-slider owl-carousel owl-theme">
                <?php
                if(isset($events->event_id)){ $eventId = $events->event_id;}
                $query =$this->db->query("select * from tbl_event_image where event_id = ".$eventId."");
                $eventsImagesSlider = $query->result();
                foreach ($eventsImagesSlider as $image) { ?>
                <div class="item">
                    <a href="<?php echo base_url().'eventdetail/'.$events->event_id; ?>"><img src="<?php if(isset($image->event_image_path) && !empty($image->event_image_path)){echo base_url().$image->event_image_path;}?>"></a>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="event-content">
            <a href="<?php echo base_url().'eventdetail/'.$events->event_id; ?>">
                <div class="heading-main" style="color:#000;">
                <h2><?php if(isset($events->event_title)) {echo $content1.'..'; }?></h2>
                <p><?php if(isset($events->event_description)){echo $content.'..';} ?></p>
                </div>
            </a>
            <div class="event-details-add">
                <div class="ppv-detl-sub">
                    <i class="fa fa-map-marker"></i>
                    <span class="add-vac"><?php if(isset($events->event_venue)){echo $events->event_venue;} ?> : <?php if(isset($events->venue_address)){echo $events->venue_address;} ?></span>
                </div>
                <div class="ppv-detl-sub">
                    <i class="fa fa-clock-o"></i>
                    <span class="add-vac"><?php if(isset($events->event_start_time)){echo $events->event_start_time;} ?> to <?php if(isset($events->event_end_time)){echo $events->event_end_time;} ?></span>
                </div>
                <div class="ppv-detl-sub">
                    <i class="fa fa-calendar"></i>
                    <span class="add-vac"><?php if(isset($events->event_date)){$date = date_create($events->event_date);
                    echo date_format($date, 'd-M-Y');}?></span>
                </div>
                <div class="event=detail-btn">
                <div class="news-txt"><p><a class="view-btn-event" href="<?php echo base_url(); ?>eventdetail/<?php echo base_url().'eventdetail/'.$events->event_id; ?>">View Event</a></p></div></div>
            </div>
        </div>
    </div>
</div>
<?php
}
} ?>
<div class="row">
    <div class="col-sm-12">
        <div class="text-center paginate">
            <?php echo $this->ajax_pagination->create_links(); ?>
            <div class="loading" style="display: none;">
                <div class="content">
                    <img src="http://dev1.groomedtrail.com/assets/images/route-loader.svg">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
$(".event-slider").owlCarousel({
navigation : true,
slideSpeed : 300,
paginationSpeed : 400,
singleItem:true,
autoPlay:true
});
});
</script>