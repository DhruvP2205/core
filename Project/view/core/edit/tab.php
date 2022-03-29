<?php $tabs = $this->getTabs(); ?>
<?php foreach($tabs as $key => $tab): ?>
    <a href="<?php echo ($this->getCurrentTab() == $key) ? '#' : $tab['url'] ?>"  <?php echo ($this->getCurrentTab() == $key) ?'style ="color:green;"' : 'style ="color:red;"' ; ?>> <?php echo $tab['title'];?> </a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php endforeach;?>
