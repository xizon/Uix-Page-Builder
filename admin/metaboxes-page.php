<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}


/*
 * Page Builder
 * 
 */ 
 
if ( !function_exists( 'uix_page_builder_page_ex_metaboxes_onepagerbuilder' ) ) {
	
	add_action( 'admin_init', 'uix_page_builder_page_ex_metaboxes_onepagerbuilder' );  
	function uix_page_builder_page_ex_metaboxes_onepagerbuilder(){  
		add_meta_box( 
			'uix_page_builder_page_meta_onepagerbuilder', 
			__( 'One-Page Builder', 'uix-page-builder' ), 
			'uix_page_builder_page_ex_metaboxes_onepagerbuilder_options', 
			'page', 
			'normal', 
			'high',
			null
		);  
	}  

}
   

if ( !function_exists( 'uix_page_builder_page_ex_metaboxes_onepagerbuilder_options' ) ) {
	
	function uix_page_builder_page_ex_metaboxes_onepagerbuilder_options( $object ) {  
	
		wp_nonce_field( basename( __FILE__ ) , 'meta-box-nonce' );
	
		$old_layoutdata = UixPageBuilder::pagebuilder_array_newlist( get_post_meta( $object->ID, 'uix-page-builder-layoutdata', true ) );
		

    ?>
   
        <a class="button button-primary" href="javascript:add_widget();"><?php _e( 'Add Section', 'uix-page-builder' ); ?></a>

        <div class="gridster uix-page-builder-gridster">
            <ul><?php
            if ( empty( $old_layoutdata ) ) {
				echo '<span id="uix-page-builder-layoutdata-none">';
				_e( 'Add section here.', 'uix-page-builder' );
				echo '</span>';
			}
			?>
            </ul>
        </div>

        <textarea name="uix-page-builder-layoutdata" id="uix-page-builder-layoutdata" ><?php echo esc_textarea( get_post_meta( $object->ID, 'uix-page-builder-layoutdata', true ) ); ?></textarea>

       
        <script type="text/javascript">
		    
			var gridsterWidth = 0;
	
			jQuery( function(){
			    gridsterWidth = jQuery( '.uix-page-builder-gridster' ).width();	

				jQuery( window ).on( 'resize', function() {
					gridsterWidgetsInit();
		
				});
				
			});
				
				
				
			var gridster = null;
			var currently_editing = null;
			var saved_data = '<?php echo json_encode( $old_layoutdata ); ?>';
			
			jQuery( function(){
				jQuery( '.gridster ul' ).gridster({
					widget_base_dimensions: [ gridsterWidth, 200 ],
					resize: {
						enabled: false
					},
					draggable: {
						stop: function() {
						    save();	
						}
					},
					serialize_params: function( $w, wgd ){ 
						var obj = {
							col: wgd.col, 
							row: wgd.row, 
							size_x: wgd.size_x, 
							size_y: wgd.size_y, 
							content: jQuery( $w[0] ).find( '.content-box' ).val().replace(/\n/g, '<br>')
						} ;
						return obj;
					}
				});

				gridster = jQuery( '.gridster ul' ).gridster().data( 'gridster' );
		

				saved_data = JSON.parse( saved_data );
				
				
				for(var iii = 0; iii < saved_data.length; iii++) {
					
					gridster.add_widget( '<li class="uix-page-builder-gridster-widget" data-row="'+saved_data[iii].row+'" data-col="'+saved_data[iii].col+'" data-sizex="'+saved_data[iii].size_x+'" data-sizey="'+saved_data[iii].size_y+'"><button class="remove-gridster-widget" onclick="remove_widget(event);"><?php _e( '&times;', 'uix-page-builder' ); ?></button><span class="debugging">[<?php _e( 'Row', 'uix-page-builder' ); ?>='+saved_data[iii].row+'][<?php _e( 'Content', 'uix-page-builder' ); ?>:<span class="content-data">'+saved_data[iii].content+'</span>]</span><textarea placeholder="<?php _e( 'HTML Code...', 'uix-page-builder' ); ?>" class="content-box">'+htmlUnescape( saved_data[iii].content )+'</textarea></li>', 1, 1 );
					     
				}
				
				gridsterWidgetsInit();
				
			});


			
			function add_widget() {
				
				var gLi = jQuery( '.gridster ul > li' ).length;
				gLi = gLi + 1;
				
				gridster.add_widget( '<li class="uix-page-builder-gridster-widget"><button class="remove-gridster-widget" onclick="remove_widget(event);"><?php _e( '&times;', 'uix-page-builder' ); ?></button><span class="debugging">[<?php _e( 'Row', 'uix-page-builder' ); ?>='+gLi+'][<?php _e( 'Content', 'uix-page-builder' ); ?>:<span class="content-data"></span>]</span><textarea placeholder="<?php _e( 'HTML Code...', 'uix-page-builder' ); ?>" class="content-box"></textarea></li>', 1, 1 ).fadeIn( 100, function() {
						inputsave();
				});
				save();
				gridsterWidgetsInit();
				jQuery( '#uix-page-builder-layoutdata-none' ).hide();
			}

			function remove_widget(e){
				e.srcElement.parentNode.setAttribute( 'id', 'remove_box' );
				gridster.remove_widget( jQuery('.gridster li#remove_box' ) );
				save();
				e.preventDefault();
			}

			function save(){
				var json_str = JSON.stringify( gridster.serialize() );
				document.getElementById( 'uix-page-builder-layoutdata' ).value = json_str;
			}
			
			
			function inputsave(){
				jQuery( document ).ready( function() {  
					jQuery( '.gridster ul > li' ).each( function() {
						var $this = jQuery( this );
						$this.find( '.content-box' ).keyup( function() {
							$this.find( 'content-data' ).html( jQuery( this ).val() );
							save();
						});
	
					});
				
				});

			}	
			
	
			function gridsterWidgetsInit() {
				jQuery( '.uix-page-builder-gridster-widget' ).css( 'width', jQuery( '.uix-page-builder-gridster' ).width() - 80 + 'px' );
			}

			function htmlUnescape( str ){
				return str
					.replace(/&quot;/g, '"')
					.replace(/&#39;/g, "'")
					.replace(/&lt;/g, '<')
					.replace(/&gt;/g, '>')
					.replace(/&amp;/g, '&')
					.replace(/<br>/g, '\n');
			}

			
			
			inputsave();	


        </script>
        
<?php  
	}  
}


 
/*
 * Saving the Custom Data
 * 
 */ 
if ( !function_exists( 'uix_page_builder_page_save_custom_meta_box' ) ) {
	
	add_action( 'save_post', 'uix_page_builder_page_save_custom_meta_box', 10, 3);
	function uix_page_builder_page_save_custom_meta_box( $post_id, $post, $update ) {
		if ( !isset( $_POST[ 'meta-box-nonce' ] ) || !wp_verify_nonce($_POST[ 'meta-box-nonce' ], basename( __FILE__ ) ) ) return $post_id;
		if( !current_user_can( 'edit_post', $post_id ) )return $post_id;
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
		
		$slug = "page";
		if( $slug != $post->post_type ) return $post_id;
		
	
		$layoutdata = "";
		
		if ( isset( $_POST[ 'uix-page-builder-layoutdata' ] ) ) {	
			$layoutdata = wp_unslash( $_POST[ 'uix-page-builder-layoutdata' ] );
			
		} else {
			$layoutdata = '';
		}
		update_post_meta( $post_id, 'uix-page-builder-layoutdata', $layoutdata );
			
	
	}

}


