<?php

function Input($props = [])
{
    $id = $props['id'] ?? '';
    $label = $props['label'] ?? '';
    $placeholder = $props['placeholder'] ?? '';
    $type = $props['type'] ?? 'text';
    $dclass = $props['dclass'] ?? 'flex-col';
    $iclass = $props['iclass'] ?? '';
    $lclass = $props['lclass'] ?? '';

    ?>
    <div class="flex gap-2 mb-2 <?php echo $dclass; ?>">
        <label for="<?php echo $id; ?>" class="text-sm color-ternary <?php echo $lclass; ?>">
            <?php echo $label; ?>
        </label>

        <input type="<?php echo $type; ?>" name="<?php echo $id?>" id="<?php echo $id; ?>" class="<?php echo $iclass; ?>"
            placeholder="<?php echo $placeholder; ?>" <?php echo $type == "file"? "accept='.jpg,.jpeg,.png'":""?> >
    </div>
    <?php
}
?>