<div class="errors">
    <?php echo validation_errors();     
    
    //array_debug($programs) ?>

</div>

<?= form_open("io/import") ?>
    <input type="file" name="userfile" class="inputitem" />
    <br /><br />
    <input type="submit" value="Vykonaj" class="inputitem" />
<?= form_close() ?>