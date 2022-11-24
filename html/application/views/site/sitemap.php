<?php header("Content-type: text/xml"); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">

<url>
	<loc><?php echo base_url(); ?></loc>
	<priority>1.00</priority>
</url>

<url>
	<loc><?php echo base_url('danh-sach-bds-mua-ban'); ?>?loai_hinh_mua_ban_bds=Mua%20Bán</loc>
	<priority>0.90</priority>
</url>


<url>
	<loc><?php echo base_url('danh-sach-bds-cho-thue'); ?>?loai_hinh_mua_ban_bds=Cho%20Thuê</loc>
	<priority>0.90</priority>
</url>

<url>
	<loc><?php echo base_url('danh-sach-bds-du-an'); ?>?du_an_status=1</loc>
	<priority>0.90</priority>
</url>

<url>
	<loc><?php echo base_url('danh-sach-bds'); ?>?du_an_status=0</loc>
	<priority>0.90</priority>
</url>

<url>
	<loc><?php echo base_url('khu-vuc'); ?></loc>
	<priority>0.90</priority>
</url>

<url>
	<loc><?php echo base_url('tin-tuc'); ?></loc>
	<priority>0.90</priority>
</url>


<?php 
    $input = array();
    $input['where'] = array('status' => '0');
    $input['order'] = array('id','desc');
    $this->db->select('id, alias');
    $list = $this->project_model->get_list($input);
?>

<?php foreach ($list as $row): ?>
<url>
	<loc><?php echo base_url($row->alias.'-pr'.$row->id) ?></loc>
	<priority>0.70</priority>
</url>
<?php endforeach;?>

<?php 
    $input = array();
    $input['where'] = array('status' => '0');
    $input['order'] = array('id','desc');
    $this->db->select('id, alias');
    $list = $this->news_model->get_list($input);
?>

<?php foreach ($list as $row): ?>
<url>
	<loc><?php echo base_url($row->alias.'-news'.$row->id) ?></loc>
	<priority>0.70</priority>
</url>
<?php endforeach;?>


</urlset>