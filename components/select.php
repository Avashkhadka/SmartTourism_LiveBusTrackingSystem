<?php

function Select($props = [])
{
    $id = $props['id'] ?? '';
    $label = $props['label'] ?? '';
    $options = $props['option'] ?? [];
    $dclass = $props['dclass'] ?? 'flex-col';
    $sclass = $props['iclass'] ?? '';
    $lclass = $props['lclass'] ?? '';

    ?>
    <div class="flex gap-2 mb-2 <?php echo $dclass; ?>">
        <label for="<?php echo $id; ?>" class="text-sm color-ternary <?php echo $lclass; ?>">
            <?php echo $label ?>
        </label>
        <select name="<?php echo $id?>" id="<?php echo $id; ?>" class="h-full border-gray px-2 rounded-lg <?php echo $sclass; ?>">
            <?php 
            foreach($options as $o){
                
            ?>
            <option value="<?php echo $o?>"><?php echo $o?></option>
            <?php
            }
            ?>



        </select>
    </div>
    <?php
}
?>