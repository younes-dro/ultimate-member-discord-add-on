<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.expresstechsoftwares.com
 * @since      1.0.0
 *
 * @package    Ultimate_Member_Discord_Add_On
 * @subpackage Ultimate_Member_Discord_Add_On/public/partials
 */
?>


<?php

Class Ultimate_Member_Discord_Add_On_Public_Display{
    
        public function __construct() {
            // Add new button in Ultimate Member profile
            add_shortcode( 'discord_connect_button', array( $this, 'ets_ultimatemember_discord_add_connect_discord_button' ) );

            add_action( 'um_after_account_general', array( $this, 'ets_ultimatemember_show_discord_button' ) );
        }
        /**
        * Add button to make connection in between user and discord
        *
        * @param NONE
        * @return NONE
        */
        public function ets_ultimatemember_discord_add_connect_discord_button(){
		if ( ! is_user_logged_in() ) {
			wp_send_json_error( 'Unauthorized user', 401 );
			exit();
		}
//		$user_id = sanitize_text_field( trim( get_current_user_id() ) );
//
//		$access_token = sanitize_text_field( trim( get_user_meta( $user_id, '_ets_pmpro_discord_access_token', true ) ) );
//
//		$allow_none_member              = sanitize_text_field( trim( get_option( 'ets_pmpro_allow_none_member' ) ) );
//		$default_role                   = sanitize_text_field( trim( get_option( '_ets_pmpro_discord_default_role_id' ) ) );
//		$ets_pmpor_discord_role_mapping = json_decode( get_option( 'ets_pmpor_discord_role_mapping' ), true );
//		$all_roles                      = unserialize( get_option( 'ets_pmpro_discord_all_roles' ) );
//		$curr_level_id                  = ets_pmpro_discord_get_current_level_id( $user_id );
//		$mapped_role_name               = '';
//		if ( $curr_level_id && is_array( $all_roles ) ) {
//			if ( is_array( $ets_pmpor_discord_role_mapping ) && array_key_exists( 'pmpro_level_id_' . $curr_level_id, $ets_pmpor_discord_role_mapping ) ) {
//				$mapped_role_id = $ets_pmpor_discord_role_mapping[ 'pmpro_level_id_' . $curr_level_id ];
//				if ( array_key_exists( $mapped_role_id, $all_roles ) ) {
//					$mapped_role_name = $all_roles[ $mapped_role_id ];
//				}
//			}
//		}
//		$default_role_name = '';
//		if ( $default_role != 'none' && is_array( $all_roles ) && array_key_exists( $default_role, $all_roles ) ) {
//			$default_role_name = $all_roles[ $default_role ];
//		}
		if ( ultimatemember_discord_check_saved_settings_status() ) {
			if ( $access_token ) {
				?>
				<label class="ets-connection-lbl"><?php echo __( 'Discord connection', 'ultimate-member-discord-add-on' ); ?></label>
				<a href="#" class="ets-btn pmpro-btn-disconnect" id="pmpro-disconnect-discord" data-user-id="<?php echo esc_attr( $user_id ); ?>"><?php echo __( 'Disconnect From Discord ', 'ultimate-member-discord-add-on' ); ?><i class='fab fa-discord'></i></a>
				<span class="ets-spinner"></span>
				<?php
			//} elseif ( pmpro_hasMembershipLevel()  ) {
                        } else {
				?>
				<label class="ets-connection-lbl"><?php echo __( 'Discord connection', 'ultimate-member-discord-add-on' ); ?></label>
				<a href="?action=discord-login" class="pmpro-btn-connect ets-btn" ><?php echo __( 'Connect To Discord', 'ultimate-member-discord-add-on' ); ?> <i class='fab fa-discord'></i></a>
				<?php if ( $mapped_role_name ) { ?>
					<p class="ets_assigned_role">
					<?php
					echo __( 'Following Roles will be assigned to you in Discord: ', 'ultimate-member-discord-add-on' );
					echo esc_html( $mapped_role_name );
					if ( $default_role_name ) {
						echo ', ' . esc_html( $default_role_name ); }
					?>
					 </p>
				<?php } ?>
				<?php
			}
		}
        }
    
	/**
	 * 
	 *
	 * @param NONE
	 * @return NONE
	 */
	public function ets_ultimatemember_show_discord_button() {
		echo do_shortcode( '[discord_connect_button]' );
	}
    
}
//new Ultimate_Member_Discord_Add_On_Public_Display();