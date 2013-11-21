<?php
include("includes.php");

$blog_obj	  = new Blogs;

$blogs		  = $blog_obj->get_blogs(" and is_active='1'",'','','',0,3,0);
?>
<div class="box-1-container">
    <ul class="list-1 p2">
    <?php foreach($blogs as $new_blogs) { ?>
        <li><span>
          <time datetime="2013-03-01"><?php echo date("n.j.Y",strtotime($new_blogs['add_date']));?></time>
          </span><a href="<?php echo 'blog_detail.php?blog='.base64_encode($new_blogs['blog_id']); ?>" target="_blank"><?php echo $new_blogs['blog_title'];?></a>
        </li>
     <?php } ?>
    </ul>
    <a href="blogs.php " class="link-1 color-3">More &nbsp;Reviews</a> 
</div>