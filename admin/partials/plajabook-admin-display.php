<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.codelabstudio.it
 * @since      1.0.0
 *
 * @package    Plajabook
 * @subpackage Plajabook/admin/partials
 */

$this->plajabook_settings_options = get_option( 'plajabook_settings_option_name' ); 


 ?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h2>Impostazioni Plajabook</h2>
    <p></p>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php
            settings_fields( 'plajabook_settings_option_group' );
            do_settings_sections( 'plajabook-settings-admin' );
            submit_button();
        ?>
        <p>
        Utilizza questo short code all'interno degli articoli:
        </p>
        <pre>
        [show_plajabook]
        </pre>
    </form>
    <p>
    Se non disponi di un account Plajabook <a href="https://www.plajabook.com" target="_blank">clicca qui</a> per richiederlo.
    </p>
</div>



