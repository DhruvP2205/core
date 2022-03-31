<!-- <?php //$tabs = $this->getTabs(); ?>
<?php //foreach($tabs as $key => $tab): ?>
    <a href="<?php //echo ($this->getCurrentTab() == $key) ? '#' : $tab['url'] ?>"  <?php //echo ($this->getCurrentTab() == $key) ?'style ="color:green;"' : 'style ="color:red;"' ; ?>> <?php //echo $tab['title'];?> </a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php //endforeach;?>
 -->


<?php $tabs = $this->getTabs(); ?>
<?php foreach($tabs as $key => $tab): ?>
    <button type="button" class="loadTab" value="<?php echo $tab['url'] ?>" <?php echo ($this->getCurrentTab() == $key) ? 'style ="color:"green;' : 'style ="color:red";' ; ?> <?php echo ($this->getCurrentTab() == $key) ? 'disabled' : '' ?>><?php echo $tab['title'];?></button>
<?php endforeach;?>


<script>
    jQuery(".loadTab").click(function(){
        admin.setUrl($(this).val());
        admin.setType('GET');
        admin.load();
    });
</script>
