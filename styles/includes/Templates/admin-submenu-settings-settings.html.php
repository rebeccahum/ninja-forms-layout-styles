<?php foreach( $settings as $setting ): ?>

    <tbody>
    <tr id="row_ninja_forms[<?php echo $setting[ 'name' ]; ?>]" class="row-ninja-forms--<?php echo $setting[ 'name' ]; ?>">
        <th scope="row">
            <label for="ninja_forms[<?php echo $setting[ 'name' ]; ?>]"><?php echo $setting[ 'label' ]; ?></label>
        </th>
        <td>

            <?php NF_Styles::template( 'admin-submenu-settings-setting-type.html.php', compact( 'setting', 'plugin_settings', 'tab', 'section' ) ); ?>

            <?php if( isset( $setting[ 'desc' ] ) ): ?>
                <p class='description'><?php echo $setting[ 'desc' ]; ?></p>
            <?php endif; ?>
        </td>
    </tr>
    </tbody>

<?php endforeach; ?>