<?php $collections = $this->getCollections(); ?>
<?php foreach($collections as $key => $collection): ?>
    <a href="<?php echo ($this->getCurrentCollection() == $key) ? '#' : $collection['url'] ?>"  <?php echo ($this->getCurrentCollection() == $key) ?'style ="color:red;"' : 'style ="color:green;"' ; ?>> <?php echo $collection['title'];?> </a>
<?php endforeach;?>
