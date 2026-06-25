<?php
function Card($class, $content,$style)
{
    ?>
    <div class="<?php echo $class ?>" style="<?php echo $style ?>">
        <div><?php echo $content['title'] ?></div>
        <div><?php echo $content['desc'] ?></div>



    </div>
    <?php
}
?>