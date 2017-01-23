<?php
if ( !class_exists( 'UixPBFormCore' ) ) {
    return;
}

/**
 * Form ID
 * ----------------------------------------------------
 */
$form_id = 'uix_pb_section_pricing2';

/**
 * Sections template parameters
 * ----------------------------------------------------
 */
$sid     = ( isset( $_POST[ 'sectionID' ] ) ) ? $_POST[ 'sectionID' ] : -1;
$pid     = ( isset( $_POST[ 'postID' ] ) ) ? $_POST[ 'postID' ] : 0;
$wname   = ( isset( $_POST[ 'widgetName' ] ) ) ? $_POST[ 'widgetName' ] : __( 'Section', 'uix-page-builder' );
$colid   = ( isset( $_POST[ 'colID' ] ) ) ? $_POST[ 'colID' ] : '';
$item    = '';



if ( $sid >= 0 ) {
	
	$builder_content   = UixPageBuilder::page_builder_array_newlist( get_post_meta( $pid, 'uix-page-builder-layoutdata', true ) );
	$item              = [];
	if ( $builder_content && is_array( $builder_content ) ) {
		foreach ( $builder_content as $key => $value ) :
			$con         = UixPageBuilder::page_builder_output( $value->content );
			
		
			if ( $con && is_array( $con ) ) {
				foreach ( $con as $key ) :
					
					$$key[ 0 ] = $key[ 1 ];
					$item[ UixPageBuilder::page_builder_item_name( $key[ 0 ] ) ]  =  $$key[ 0 ];
				endforeach;
			}
	
	        //loop content
			$col_content = UixPageBuilder::page_builder_analysis_rowcontent( UixPageBuilder::prerow_value( $item ), 'content' );
			
			
			if ( $col_content && is_array( $col_content ) ) {
				foreach ( $col_content as $key ) :
				    
					$detail_content = $key;
					
					//column id
					$colname           = $form_id.'-col';
					$cname             = str_replace( $form_id.'|', '', $key[1][0] );
					$id                = $key[0][1];
					$item[ $colname ]   =  $id;  //Usage: $item[ 'uix_pb_section_xxx-col' ];
					
				
					foreach ( $detail_content as $value ) :	
						$name           = str_replace( $form_id.'|', '', $value[0] );
						$content        = $value[1];
						$item[ $name ]  =  $content;	  //Usage:  $item[ 'uix_pb_section_xxx|[col-item-1_1---0][uix_pb_xxx_xxx][0]' ];
						
					endforeach;
					
					
				endforeach;
			}	
		
		endforeach;
		

	}
	
	
}

/**
 * Element Template
 * ----------------------------------------------------
 */
$uix_pb_pricing_col4_config_title         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_config_title', __( 'Text Here', 'uix-page-builder' ) );
$uix_pb_pricing_col4_config_intro         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_config_intro', __( 'This is the description text for the title.', 'uix-page-builder' ) );

$uix_pb_pricing_col4_one_title            = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_one_title', __( 'free', 'uix-page-builder' ) );
$uix_pb_pricing_col4_one_price            = floatval( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_one_price', 49 ) );
$uix_pb_pricing_col4_one_emphasis_color   = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_one_emphasis_color', '#d59a3e' );
$uix_pb_pricing_col4_one_currency         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_one_currency', __( '$', 'uix-page-builder' ) );
$uix_pb_pricing_col4_one_period           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_one_period', __( 'per month', 'uix-page-builder' ) );
$uix_pb_pricing_col4_one_desc             = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_one_desc', __( 'Some description text here.', 'uix-page-builder' ) );
$uix_pb_pricing_col4_one_btn_label        = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_one_btn_label', __( 'TRY FOR FREE', 'uix-page-builder' ) );
$uix_pb_pricing_col4_one_btn_link         = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_one_btn_link', '#' ) );
$uix_pb_pricing_col4_one_btn_color        = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_one_btn_color', '#a2bf2f' );
$uix_pb_pricing_col4_one_btn_win          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_one_btn_win', 0 ); // 0:false  1:true
$uix_pb_pricing_col4_one_btn_win_chk      = ( $uix_pb_pricing_col4_one_btn_win == 1 ) ? true : false;
$uix_pb_pricing_col4_one_features         = UixPageBuilder::html_listTran( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_one_features', __( 'Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s>', 'uix-page-builder' ) ) );
$uix_pb_pricing_col4_one_active           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_one_active', 0 ); // 0:false  1:true
$uix_pb_pricing_col4_one_active_chk       = ( $uix_pb_pricing_col4_one_active == 1 ) ? true : false;

//---
$uix_pb_pricing_col4_two_title            = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_two_title', __( 'premium', 'uix-page-builder' ) );
$uix_pb_pricing_col4_two_price            = floatval( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_two_price', 69 ) );
$uix_pb_pricing_col4_two_emphasis_color   = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_two_emphasis_color', '#d59a3e' );
$uix_pb_pricing_col4_two_currency         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_two_currency', __( '$', 'uix-page-builder' ) );
$uix_pb_pricing_col4_two_period           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_two_period', __( 'per month', 'uix-page-builder' ) );
$uix_pb_pricing_col4_two_desc             = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_two_desc', __( 'Some description text here.', 'uix-page-builder' ) );
$uix_pb_pricing_col4_two_btn_label        = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_two_btn_label', __( 'BUY', 'uix-page-builder' ) );
$uix_pb_pricing_col4_two_btn_link         = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_two_btn_link', '#' ) );
$uix_pb_pricing_col4_two_btn_color        = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_two_btn_color', '#a2bf2f' );
$uix_pb_pricing_col4_two_btn_win          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_two_btn_win', 0 ); // 0:false  1:true
$uix_pb_pricing_col4_two_btn_win_chk      = ( $uix_pb_pricing_col4_two_btn_win == 1 ) ? true : false;
$uix_pb_pricing_col4_two_features         = UixPageBuilder::html_listTran( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_two_features', __( 'Feature Description<br>Another Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s>', 'uix-page-builder' ) ) );
$uix_pb_pricing_col4_two_active           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_two_active', 1 ); // 0:false  1:true
$uix_pb_pricing_col4_two_active_chk       = ( $uix_pb_pricing_col4_two_active == 1 ) ? true : false;


//--
$uix_pb_pricing_col4_three_title          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_three_title', __( 'professional', 'uix-page-builder' ) );
$uix_pb_pricing_col4_three_price          = floatval( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_three_price', 109 ) );
$uix_pb_pricing_col4_three_emphasis_color = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_three_emphasis_color', '#d59a3e' );
$uix_pb_pricing_col4_three_currency       = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_three_currency', __( '$', 'uix-page-builder' ) );
$uix_pb_pricing_col4_three_period         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_three_period', __( 'per month', 'uix-page-builder' ) );
$uix_pb_pricing_col4_three_desc           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_three_desc', __( 'Some description text here.', 'uix-page-builder' ) );
$uix_pb_pricing_col4_three_btn_label      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_three_btn_label', __( 'BUY', 'uix-page-builder' ) );
$uix_pb_pricing_col4_three_btn_link       = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_three_btn_link', '#' ) );
$uix_pb_pricing_col4_three_btn_color      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_three_btn_color', '#a2bf2f' );
$uix_pb_pricing_col4_three_btn_win        = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_three_btn_win', 0 ); // 0:false  1:true
$uix_pb_pricing_col4_three_btn_win_chk    = ( $uix_pb_pricing_col4_three_btn_win == 1 ) ? true : false;
$uix_pb_pricing_col4_three_features       = UixPageBuilder::html_listTran( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_three_features', __( 'Feature Description<br>Another Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s><br>Another Feature Description', 'uix-page-builder' ) ) );
$uix_pb_pricing_col4_three_active         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_three_active', 0 ); // 0:false  1:true
$uix_pb_pricing_col4_three_active_chk     = ( $uix_pb_pricing_col4_three_active == 1 ) ? true : false;


//--
$uix_pb_pricing_col4_four_title          = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_four_title', __( 'expand', 'uix-page-builder' ) );
$uix_pb_pricing_col4_four_price          = floatval( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_four_price', 139 ) );
$uix_pb_pricing_col4_four_emphasis_color = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_four_emphasis_color', '#d59a3e' );
$uix_pb_pricing_col4_four_currency       = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_four_currency', __( '$', 'uix-page-builder' ) );
$uix_pb_pricing_col4_four_period         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_four_period', __( 'per month', 'uix-page-builder' ) );
$uix_pb_pricing_col4_four_desc           = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_four_desc', __( 'Some description text here.', 'uix-page-builder' ) );
$uix_pb_pricing_col4_four_btn_label      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_four_btn_label', __( 'BUY', 'uix-page-builder' ) );
$uix_pb_pricing_col4_four_btn_link       = esc_url( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_four_btn_link', '#' ) );
$uix_pb_pricing_col4_four_btn_color      = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_four_btn_color', '#a2bf2f' );
$uix_pb_pricing_col4_four_btn_win        = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_four_btn_win', 0 ); // 0:false  1:true
$uix_pb_pricing_col4_four_btn_win_chk    = ( $uix_pb_pricing_col4_four_btn_win == 1 ) ? true : false;
$uix_pb_pricing_col4_four_features       = UixPageBuilder::html_listTran( UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_four_features', __( 'Feature Description<br>Another Feature Description<br>Another Feature Description<br><s>Invalid Feature Description</s><br>Another Feature Description<br>Another Feature Description', 'uix-page-builder' ) ) );
$uix_pb_pricing_col4_four_active         = UixPageBuilder::fvalue( $colid, $sid, $item, 'uix_pb_pricing_col4_four_active', 0 ); // 0:false  1:true
$uix_pb_pricing_col4_four_active_chk     = ( $uix_pb_pricing_col4_four_active == 1 ) ? true : false;




$element_temp = '
{heading}
{desc}
<div class="uix-pb-price">
	<div class="uix-pb-row">
		<div class="uix-pb-col-3 uix-pb-price-border-hover" data-tcolor="{imcolor_one}">
			<div class="uix-pb-price-bg-hover uix-pb-price-init-height">
				<div class="uix-pb-price-border {imclass_one}">
					<h5 class="uix-pb-price-level">{title_one}</h5>
					<h2 class="uix-pb-price-num" style="color:{imcolor_one}">{currency_one}{price_one} <span class="uix-pb-price-period">{period_one}</span></h2>
					<div class="uix-pb-price-excerpt">
						<p>{desc_one}</p>
					</div> <a href="{btnurl_one}" {win_one} class="uix-pb-btn uix-pb-btn-small uix-pb-btn-bg-{btncolor_one}">{btnlabel_one}</a>
					<hr>
					<div class="uix-pb-price-detail">
						<ul>
							{features_one}
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<div class="uix-pb-col-3 uix-pb-price-border-hover" data-tcolor="{imcolor_two}">
			<div class="uix-pb-price-bg-hover uix-pb-price-init-height">
				<div class="uix-pb-price-border {imclass_two}">
					<h5 class="uix-pb-price-level">{title_two}</h5>
					<h2 class="uix-pb-price-num" style="color:{imcolor_two}">{currency_two}{price_two} <span class="uix-pb-price-period">{period_two}</span></h2>
					<div class="uix-pb-price-excerpt">
						<p>{desc_two}</p>
					</div> <a href="{btnurl_two}" {win_two} class="uix-pb-btn uix-pb-btn-small uix-pb-btn-bg-{btncolor_two}">{btnlabel_two}</a>
					<hr>
					<div class="uix-pb-price-detail">
						<ul>
							{features_two}
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="uix-pb-col-3 uix-pb-price-border-hover" data-tcolor="{imcolor_three}">
			<div class="uix-pb-price-bg-hover uix-pb-price-init-height">
				<div class="uix-pb-price-border {imclass_three}">
					<h5 class="uix-pb-price-level">{title_three}</h5>
					<h2 class="uix-pb-price-num" style="color:{imcolor_three}">{currency_three}{price_three} <span class="uix-pb-price-period">{period_three}</span></h2>
					<div class="uix-pb-price-excerpt">
						<p>{desc_three}</p>
					</div> <a href="{btnurl_three}" {win_three} class="uix-pb-btn uix-pb-btn-small uix-pb-btn-bg-{btncolor_three}">{btnlabel_three}</a>
					<hr>
					<div class="uix-pb-price-detail">
						<ul>
							{features_three}
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="uix-pb-col-3 uix-pb-col-last uix-pb-price-border-hover" data-tcolor="{imcolor_four}">
			<div class="uix-pb-price-bg-hover uix-pb-price-init-height">
				<div class="uix-pb-price-border {imclass_four}">
					<h5 class="uix-pb-price-level">{title_four}</h5>
					<h2 class="uix-pb-price-num" style="color:{imcolor_four}">{currency_four}{price_four} <span class="uix-pb-price-period">{period_four}</span></h2>
					<div class="uix-pb-price-excerpt">
						<p>{desc_four}</p>
					</div> <a href="{btnurl_four}" {win_four} class="uix-pb-btn uix-pb-btn-small uix-pb-btn-bg-{btncolor_four}">{btnlabel_four}</a>
					<hr>
					<div class="uix-pb-price-detail">
						<ul>
							{features_four}
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
	<!-- /.uix-pb-row -->
</div>
<!-- /.uix-pb-price -->
';
 
 
$win_one        = ( $uix_pb_pricing_col4_one_btn_win == 1 ) ? 'target="_blank"' : '';
$win_two        = ( $uix_pb_pricing_col4_two_btn_win == 1 ) ? 'target="_blank"' : '';
$win_three      = ( $uix_pb_pricing_col4_three_btn_win == 1 ) ? 'target="_blank"' : '';
$win_four       = ( $uix_pb_pricing_col4_four_btn_win == 1 ) ? 'target="_blank"' : '';


$imclass_one    = ( $uix_pb_pricing_col4_one_active == 1 ) ? 'uix-pb-price-important' : '';
$imclass_two    = ( $uix_pb_pricing_col4_two_active == 1 ) ? 'uix-pb-price-important' : '';
$imclass_three  = ( $uix_pb_pricing_col4_three_active == 1 ) ? 'uix-pb-price-important' : '';
$imclass_four   = ( $uix_pb_pricing_col4_four_active == 1 ) ? 'uix-pb-price-important' : '';


$btncolor_one   = UixPageBuilder::color_tran( $uix_pb_pricing_col4_one_btn_color );
$btncolor_two   = UixPageBuilder::color_tran( $uix_pb_pricing_col4_two_btn_color );
$btncolor_three = UixPageBuilder::color_tran( $uix_pb_pricing_col4_three_btn_color );
$btncolor_four  = UixPageBuilder::color_tran( $uix_pb_pricing_col4_four_btn_color );


$uix_pb_section_pricing2_temp = str_replace( '{imcolor_one}', esc_attr( $uix_pb_pricing_col4_one_emphasis_color ),
                                  str_replace( '{imclass_one}', esc_attr( $imclass_one ), 
								  str_replace( '{title_one}', uix_pb_kses( $uix_pb_pricing_col4_one_title ), 
								  str_replace( '{period_one}', uix_pb_kses( $uix_pb_pricing_col4_one_period ), 
								  str_replace( '{desc_one}', uix_pb_kses( $uix_pb_pricing_col4_one_desc ),	
								  str_replace( '{btnlabel_one}', esc_html( $uix_pb_pricing_col4_one_btn_label ),	
								  str_replace( '{currency_one}', esc_html( $uix_pb_pricing_col4_one_currency ),
								  str_replace( '{price_one}', esc_html( $uix_pb_pricing_col4_one_price ),		  
								  str_replace( '{btnurl_one}', esc_url( $uix_pb_pricing_col4_one_btn_link ), 
								  str_replace( '{btncolor_one}', esc_attr( $btncolor_one ), 		  
								  str_replace( '{win_one}', $win_one,
								  str_replace( '{features_one}', uix_pb_kses( $uix_pb_pricing_col4_one_features ),	
											  
                                  str_replace( '{imcolor_two}', esc_attr( $uix_pb_pricing_col4_two_emphasis_color ),
                                  str_replace( '{imclass_two}', esc_attr( $imclass_two ), 
								  str_replace( '{title_two}', uix_pb_kses( $uix_pb_pricing_col4_two_title ), 
								  str_replace( '{period_two}', uix_pb_kses( $uix_pb_pricing_col4_two_period ), 
								  str_replace( '{desc_two}', uix_pb_kses( $uix_pb_pricing_col4_two_desc ),	
								  str_replace( '{btnlabel_two}', esc_html( $uix_pb_pricing_col4_two_btn_label ),	
								  str_replace( '{currency_two}', esc_html( $uix_pb_pricing_col4_two_currency ),
								  str_replace( '{price_two}', esc_html( $uix_pb_pricing_col4_two_price ),		  
								  str_replace( '{btnurl_two}', esc_url( $uix_pb_pricing_col4_two_btn_link ), 
								  str_replace( '{btncolor_two}', esc_attr( $btncolor_two ), 		  
								  str_replace( '{win_two}', $win_two,
								  str_replace( '{features_two}', uix_pb_kses( $uix_pb_pricing_col4_two_features ),	
											  
                                  str_replace( '{imcolor_three}', esc_attr( $uix_pb_pricing_col4_three_emphasis_color ),
                                  str_replace( '{imclass_three}', esc_attr( $imclass_three ), 
								  str_replace( '{title_three}', uix_pb_kses( $uix_pb_pricing_col4_three_title ), 
								  str_replace( '{period_three}', uix_pb_kses( $uix_pb_pricing_col4_three_period ), 
								  str_replace( '{desc_three}', uix_pb_kses( $uix_pb_pricing_col4_three_desc ),	
								  str_replace( '{btnlabel_three}', esc_html( $uix_pb_pricing_col4_three_btn_label ),	
								  str_replace( '{currency_three}', esc_html( $uix_pb_pricing_col4_three_currency ),
								  str_replace( '{price_three}', esc_html( $uix_pb_pricing_col4_three_price ),		  
								  str_replace( '{btnurl_three}', esc_url( $uix_pb_pricing_col4_three_btn_link ), 
								  str_replace( '{btncolor_three}', esc_attr( $btncolor_three ), 		  
								  str_replace( '{win_three}', $win_three,
								  str_replace( '{features_three}', uix_pb_kses( $uix_pb_pricing_col4_three_features ),	
											  
											  
                                  str_replace( '{imcolor_four}', esc_attr( $uix_pb_pricing_col4_four_emphasis_color ),
                                  str_replace( '{imclass_four}', esc_attr( $imclass_four ), 
								  str_replace( '{title_four}', uix_pb_kses( $uix_pb_pricing_col4_four_title ), 
								  str_replace( '{period_four}', uix_pb_kses( $uix_pb_pricing_col4_four_period ), 
								  str_replace( '{desc_four}', uix_pb_kses( $uix_pb_pricing_col4_four_desc ),	
								  str_replace( '{btnlabel_four}', esc_html( $uix_pb_pricing_col4_four_btn_label ),	
								  str_replace( '{currency_four}', esc_html( $uix_pb_pricing_col4_four_currency ),
								  str_replace( '{price_four}', esc_html( $uix_pb_pricing_col4_four_price ),		  
								  str_replace( '{btnurl_four}', esc_url( $uix_pb_pricing_col4_four_btn_link ), 
								  str_replace( '{btncolor_four}', esc_attr( $btncolor_four ), 		  
								  str_replace( '{win_four}', $win_four,
								  str_replace( '{features_four}', uix_pb_kses( $uix_pb_pricing_col4_four_features ),					  
											  
								 str_replace( '{heading}', ( !empty( $uix_pb_pricing_col4_config_title ) ? '<h2 class="uix-pb-section-heading">'.$uix_pb_pricing_col4_config_title.'</h2><div class="uix-pb-section-hr"></div>' : '' ),
								 str_replace( '{desc}', ( !empty( $uix_pb_pricing_col4_config_intro ) ? '<div class="uix-pb-section-desc">'.$uix_pb_pricing_col4_config_intro.'</div>' : '' ),			  

							     $element_temp 
								 )))))))))))) )))))))))))) )))))))))))) )))))))))))) ));



/**
 * Form Type & Parameters
 * ----------------------------------------------------
 */

$form_type_config = [
    'list' => 1
];



$args_config = 
	[
	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_config_title' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_config_title' ),
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_config_title,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
	
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_config_intro' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_config_intro' ),
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_config_intro,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 3,
									'format'  => true
								)
		
		),
		
	
	]
;


$form_type = [
    'list' => 4
];


$args_1 = 
	[
	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_title' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_one_title' ),
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_one_title,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_price' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_one_price' ),
			'title'          => __( 'Price', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_one_price,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_emphasis_color' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_one_emphasis_color' ),
			'title'          => __( 'Price Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_one_emphasis_color,
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),
		
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_currency' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_one_currency' ),
			'title'          => __( 'Currency', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_one_currency,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_period' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_one_period' ),
			'title'          => __( 'Period', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_one_period,
			'placeholder'    => '',
			'type'           => 'text'
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_desc' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_one_desc' ),
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_one_desc,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2,
									'format'  => true
				                )
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_btn_label' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_one_btn_label' ),
			'title'          => __( 'Button Label', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_one_btn_label,
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_btn_link' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_one_btn_link' ),
			'title'          => __( 'Button Link', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_one_btn_link,
			'placeholder'    => 'URL',
			'type'           => 'text'
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_btn_color' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_one_btn_color' ),
			'title'          => __( 'Button Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_one_btn_color,
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_btn_win' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_one_btn_win' ),
			'title'          => __( 'Open in new tab', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_one_btn_win,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_pricing_col4_one_btn_win_chk
				                )
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_features' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_one_features' ),
			'title'          => __( 'Features', 'uix-page-builder' ),
			'desc'           => __( 'Type one word or sentence per line when press "ENTER".', 'uix-page-builder' ),
			'value'          => $uix_pb_pricing_col4_one_features,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'                       => 5,
									'format'                    => true
									
				                )
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_active' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_one_active' ),
			'title'          => __( 'Active', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_one_active,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_pricing_col4_one_active_chk
				                )
		
		),

	
	]
;


$args_2 = 
	[
	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_title' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_two_title' ),
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_two_title,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_price' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_two_price' ),
			'title'          => __( 'Price', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_two_price,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_emphasis_color' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_two_emphasis_color' ),
			'title'          => __( 'Price Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_two_emphasis_color,
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),
		
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_currency' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_two_currency' ),
			'title'          => __( 'Currency', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_two_currency,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_period' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_two_period' ),
			'title'          => __( 'Period', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_two_period,
			'placeholder'    => '',
			'type'           => 'text'
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_desc' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_two_desc' ),
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_two_desc,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2,
									'format'  => true
				                )
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_btn_label' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_two_btn_label' ),
			'title'          => __( 'Button Label', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_two_btn_label,
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_btn_link' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_two_btn_link' ),
			'title'          => __( 'Button Link', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_two_btn_link,
			'placeholder'    => 'URL',
			'type'           => 'text'
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_btn_color' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_two_btn_color' ),
			'title'          => __( 'Button Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_two_btn_color,
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_btn_win' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_two_btn_win' ),
			'title'          => __( 'Open in new tab', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_two_btn_win,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_pricing_col4_two_btn_win_chk
				                )
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_features' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_two_features' ),
			'title'          => __( 'Features', 'uix-page-builder' ),
			'desc'           => __( 'Type one word or sentence per line when press "ENTER".', 'uix-page-builder' ),
			'value'          => $uix_pb_pricing_col4_two_features,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'                       => 5,
									'format'                    => true
									
				                )
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_active' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_two_active' ),
			'title'          => __( 'Active', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_two_active,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_pricing_col4_two_active_chk
				                )
		
		),

	
	]
;

$args_3 = 
	[
	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_title' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_three_title' ),
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_three_title,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_price' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_three_price' ),
			'title'          => __( 'Price', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_three_price,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_emphasis_color' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_three_emphasis_color' ),
			'title'          => __( 'Price Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_three_emphasis_color,
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),
		
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_currency' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_three_currency' ),
			'title'          => __( 'Currency', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_three_currency,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_period' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_three_period' ),
			'title'          => __( 'Period', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_three_period,
			'placeholder'    => '',
			'type'           => 'text'
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_desc' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_three_desc' ),
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_three_desc,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2,
									'format'  => true
				                )
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_btn_label' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_three_btn_label' ),
			'title'          => __( 'Button Label', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_three_btn_label,
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_btn_link' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_three_btn_link' ),
			'title'          => __( 'Button Link', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_three_btn_link,
			'placeholder'    => 'URL',
			'type'           => 'text'
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_btn_color' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_three_btn_color' ),
			'title'          => __( 'Button Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_three_btn_color,
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_btn_win' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_three_btn_win' ),
			'title'          => __( 'Open in new tab', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_three_btn_win,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_pricing_col4_three_btn_win_chk
				                )
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_features' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_three_features' ),
			'title'          => __( 'Features', 'uix-page-builder' ),
			'desc'           => __( 'Type one word or sentence per line when press "ENTER".', 'uix-page-builder' ),
			'value'          => $uix_pb_pricing_col4_three_features,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'                       => 5,
									'format'                    => true
									
				                )
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_active' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_three_active' ),
			'title'          => __( 'Active', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_three_active,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_pricing_col4_three_active_chk
				                )
		
		),
		
		

	
	]
;


$args_4 = 
	[
	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_title' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_four_title' ),
			'title'          => __( 'Title', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_four_title,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_price' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_four_price' ),
			'title'          => __( 'Price', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_four_price,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_emphasis_color' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_four_emphasis_color' ),
			'title'          => __( 'Price Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_four_emphasis_color,
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),
		
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_currency' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_four_currency' ),
			'title'          => __( 'Currency', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_four_currency,
			'placeholder'    => '',
			'type'           => 'text'
		
		),
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_period' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_four_period' ),
			'title'          => __( 'Period', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_four_period,
			'placeholder'    => '',
			'type'           => 'text'
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_desc' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_four_desc' ),
			'title'          => __( 'Description', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_four_desc,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'     => 2,
									'format'  => true
				                )
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_btn_label' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_four_btn_label' ),
			'title'          => __( 'Button Label', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_four_btn_label,
			'placeholder'    => '',
			'type'           => 'text'
		
		),		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_btn_link' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_four_btn_link' ),
			'title'          => __( 'Button Link', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_four_btn_link,
			'placeholder'    => 'URL',
			'type'           => 'text'
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_btn_color' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_four_btn_color' ),
			'title'          => __( 'Button Color', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_four_btn_color,
			'placeholder'    => '',
			'type'           => 'color',
			'default'        => [ '#a2bf2f', '#d59a3e', '#DD514C', '#FA9ADF', '#4BB1CF',  '#0E90D2', '#5F9EA0', '#473f3f',  '#bebebe' ]
		
		),
		
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_btn_win' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_four_btn_win' ),
			'title'          => __( 'Open in new tab', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_four_btn_win,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_pricing_col4_four_btn_win_chk
				                )
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_features' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_four_features' ),
			'title'          => __( 'Features', 'uix-page-builder' ),
			'desc'           => __( 'Type one word or sentence per line when press "ENTER".', 'uix-page-builder' ),
			'value'          => $uix_pb_pricing_col4_four_features,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'row'                       => 5,
									'format'                    => true
									
				                )
		
		),	
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_active' ),
		    'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_pricing_col4_four_active' ),
			'title'          => __( 'Active', 'uix-page-builder' ),
			'desc'           => '',
			'value'          => $uix_pb_pricing_col4_four_active,
			'placeholder'    => '',
			'type'           => 'checkbox',
			'default'        => array(
									'checked'  => $uix_pb_pricing_col4_four_active_chk
				                )
		
		),
		
		
        //------- template
		array(
			'id'             => UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_pricing2_temp' ),
			'name'           => UixPageBuilder::fname( $colid, $form_id, 'uix_pb_section_pricing2_temp' ),
			'title'          => '',
			'desc'           => '',
			'value'          => $uix_pb_section_pricing2_temp,
			'placeholder'    => '',
			'type'           => 'textarea',
			'default'        => array(
									'hide' => true
								)
		
		),	
			

	
	]
;


//---
$form_html = UixPBFormCore::form_before( $colid, $wname, $sid, $form_id );


$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'html', __( 'General Settings', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_1, 'html', __( 'Table 1', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_2, 'html', __( 'Table 2', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_3, 'html', __( 'Table 3', 'uix-page-builder' ) );
$form_html .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_4, 'html', __( 'Table 4', 'uix-page-builder' ) );

$form_html .= UixPBFormCore::form_after();

//----

$form_js = '';
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_1, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_2, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_3, 'js' );
$form_js .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_4, 'js' );

//----

$form_js_vars = '';
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type_config, $args_config, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_1, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_2, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_3, 'js_vars' );
$form_js_vars .= UixPBFormCore::add_form( $colid, $wname, $sid, $form_id, $form_type, $args_4, 'js_vars' );


/**
 * Returns actions of javascript
 * ----------------------------------------------------
 */

if ( $sid == -1 && is_admin() ) {
	if( UixPageBuilder::page_builder_mode() ) {
		if ( is_admin()) {
			
			?>
			<script type="text/javascript">
			( function($) {
			'use strict';
				$( document ).ready( function() {  
					<?php echo UixPBFormCore::uixpbform_callback( $form_js, $form_js_vars, $form_id, __( 'Pricing Table (4 column)', 'uix-page-builder' ) ); ?>         
				} ); 
			} ) ( jQuery );
			</script>
	 
			<?php
	
			
		}
	}
	
}


/**
 * Returns forms with ajax
 * ----------------------------------------------------
 */
if ( $sid >= 0 && is_admin() ) {
	echo $form_html;	
	?>
    
<script type="text/javascript">
( function($) {
'use strict';
	$( document ).ready( function() {
		
		
		$( document ).on( "change keyup focusout", "[name^='<?php echo $form_id; ?>|[<?php echo $colid; ?>]']", function() {
			
			var tempcode                                 = '<?php echo UixPBFormCore::str_compression( $element_temp ); ?>',
				uix_pb_pricing_col4_config_title         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_config_title' ); ?>' ).val(),
				uix_pb_pricing_col4_config_intro         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_config_intro' ); ?>' ).val(),

				uix_pb_pricing_col4_one_title            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_title' ); ?>' ).val(),
				uix_pb_pricing_col4_one_price            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_price' ); ?>' ).val(),
				uix_pb_pricing_col4_one_emphasis_color   = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_emphasis_color' ); ?>' ).val(),
				uix_pb_pricing_col4_one_currency         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_currency' ); ?>' ).val(),
				uix_pb_pricing_col4_one_period           = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_period' ); ?>' ).val(),
				uix_pb_pricing_col4_one_desc             = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_desc' ); ?>' ).val(),
				uix_pb_pricing_col4_one_btn_label        = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_btn_label' ); ?>' ).val(),
				uix_pb_pricing_col4_one_btn_link         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_btn_link' ); ?>' ).val(),
				uix_pb_pricing_col4_one_btn_color        = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_btn_color' ); ?>' ).val(),
				uix_pb_pricing_col4_one_btn_win_chk      = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_btn_win' ); ?>-checkbox' ).is( ":checked" ),
				uix_pb_pricing_col4_one_features         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_features' ); ?>' ).val(),
				uix_pb_pricing_col4_one_active_chk       = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_one_active' ); ?>-checkbox' ).is( ":checked" ),

				uix_pb_pricing_col4_two_title            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_title' ); ?>' ).val(),
				uix_pb_pricing_col4_two_price            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_price' ); ?>' ).val(),
				uix_pb_pricing_col4_two_emphasis_color   = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_emphasis_color' ); ?>' ).val(),
				uix_pb_pricing_col4_two_currency         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_currency' ); ?>' ).val(),
				uix_pb_pricing_col4_two_period           = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_period' ); ?>' ).val(),
				uix_pb_pricing_col4_two_desc             = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_desc' ); ?>' ).val(),
				uix_pb_pricing_col4_two_btn_label        = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_btn_label' ); ?>' ).val(),
				uix_pb_pricing_col4_two_btn_link         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_btn_link' ); ?>' ).val(),
				uix_pb_pricing_col4_two_btn_color        = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_btn_color' ); ?>' ).val(),
				uix_pb_pricing_col4_two_btn_win_chk      = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_btn_win' ); ?>-checkbox' ).is( ":checked" ),
				uix_pb_pricing_col4_two_features         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_features' ); ?>' ).val(),
				uix_pb_pricing_col4_two_active_chk       = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_two_active' ); ?>-checkbox' ).is( ":checked" ),

				uix_pb_pricing_col4_three_title            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_title' ); ?>' ).val(),
				uix_pb_pricing_col4_three_price            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_price' ); ?>' ).val(),
				uix_pb_pricing_col4_three_emphasis_color   = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_emphasis_color' ); ?>' ).val(),
				uix_pb_pricing_col4_three_currency         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_currency' ); ?>' ).val(),
				uix_pb_pricing_col4_three_period           = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_period' ); ?>' ).val(),
				uix_pb_pricing_col4_three_desc             = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_desc' ); ?>' ).val(),
				uix_pb_pricing_col4_three_btn_label        = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_btn_label' ); ?>' ).val(),
				uix_pb_pricing_col4_three_btn_link         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_btn_link' ); ?>' ).val(),
				uix_pb_pricing_col4_three_btn_color        = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_btn_color' ); ?>' ).val(),
				uix_pb_pricing_col4_three_btn_win_chk      = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_btn_win' ); ?>-checkbox' ).is( ":checked" ),
				uix_pb_pricing_col4_three_features         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_features' ); ?>' ).val(),
				uix_pb_pricing_col4_three_active_chk       = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_three_active' ); ?>-checkbox' ).is( ":checked" ),
				
				
				uix_pb_pricing_col4_four_title            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_title' ); ?>' ).val(),
				uix_pb_pricing_col4_four_price            = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_price' ); ?>' ).val(),
				uix_pb_pricing_col4_four_emphasis_color   = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_emphasis_color' ); ?>' ).val(),
				uix_pb_pricing_col4_four_currency         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_currency' ); ?>' ).val(),
				uix_pb_pricing_col4_four_period           = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_period' ); ?>' ).val(),
				uix_pb_pricing_col4_four_desc             = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_desc' ); ?>' ).val(),
				uix_pb_pricing_col4_four_btn_label        = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_btn_label' ); ?>' ).val(),
				uix_pb_pricing_col4_four_btn_link         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_btn_link' ); ?>' ).val(),
				uix_pb_pricing_col4_four_btn_color        = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_btn_color' ); ?>' ).val(),
				uix_pb_pricing_col4_four_btn_win_chk      = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_btn_win' ); ?>-checkbox' ).is( ":checked" ),
				uix_pb_pricing_col4_four_features         = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_features' ); ?>' ).val(),
				uix_pb_pricing_col4_four_active_chk       = $( '#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_pricing_col4_four_active' ); ?>-checkbox' ).is( ":checked" );		
			
			
			if ( tempcode.length > 0 ) {
				
				
				var win_one        = ( uix_pb_pricing_col4_one_btn_win_chk === true ) ? 'target="_blank"' : '',
					win_two        = ( uix_pb_pricing_col4_two_btn_win_chk === true ) ? 'target="_blank"' : '',
					win_three      = ( uix_pb_pricing_col4_three_btn_win_chk === true ) ? 'target="_blank"' : '',
					win_four       = ( uix_pb_pricing_col4_four_btn_win_chk === true ) ? 'target="_blank"' : '',

					imclass_one    = ( uix_pb_pricing_col4_one_active_chk === true ) ? 'uix-pb-price-important' : '',
					imclass_two    = ( uix_pb_pricing_col4_two_active_chk === true ) ? 'uix-pb-price-important' : '',
					imclass_three  = ( uix_pb_pricing_col4_three_active_chk === true ) ? 'uix-pb-price-important' : '',
					imclass_four   = ( uix_pb_pricing_col4_four_active_chk === true ) ? 'uix-pb-price-important' : '',

					btncolor_one   = uixpbform_colorTran( uix_pb_pricing_col4_one_btn_color ),
					btncolor_two   = uixpbform_colorTran( uix_pb_pricing_col4_two_btn_color ),
					btncolor_three = uixpbform_colorTran( uix_pb_pricing_col4_three_btn_color ),
				    btncolor_four  = uixpbform_colorTran( uix_pb_pricing_col4_four_btn_color );

				
				var _config_t      = ( uix_pb_pricing_col4_config_title != undefined && uix_pb_pricing_col4_config_title != '' ) ? '<h2 class="uix-pb-section-heading">'+uix_pb_pricing_col4_config_title+'</h2><div class="uix-pb-section-hr"></div>' : '',
					_config_desc   = ( uix_pb_pricing_col4_config_intro != undefined && uix_pb_pricing_col4_config_intro != '' ) ? '<div class="uix-pb-section-desc">'+uix_pb_pricing_col4_config_intro+'</div>' : '';
						
				
				
				
				//---
				tempcode = tempcode
                                  .replace(/{imcolor_one}/g, uixpbform_htmlEncode( uix_pb_pricing_col4_one_emphasis_color ) )
                                  .replace(/{imclass_one}/g, uixpbform_htmlEncode( imclass_one ) )
								  .replace(/{title_one}/g, uix_pb_pricing_col4_one_title ) 
								  .replace(/{period_one}/g, uix_pb_pricing_col4_one_period ) 
								  .replace(/{desc_one}/g, uix_pb_pricing_col4_one_desc )	
								  .replace(/{btnlabel_one}/g, uix_pb_pricing_col4_one_btn_label )	
								  .replace(/{currency_one}/g, uix_pb_pricing_col4_one_currency )
								  .replace(/{price_one}/g, uixpbform_floatval( uix_pb_pricing_col4_one_price ) )		  
								  .replace(/{btnurl_one}/g, encodeURI( uix_pb_pricing_col4_one_btn_link ) ) 
								  .replace(/{btncolor_one}/g, btncolor_one ) 
								  .replace(/{win_one}/g, win_one )
								  .replace(/{features_one}/g, uixpbform_html_listTran( uix_pb_pricing_col4_one_features, 'li' ) )	
											  
                                  .replace(/{imcolor_two}/g, uixpbform_htmlEncode( uix_pb_pricing_col4_two_emphasis_color ) )
                                  .replace(/{imclass_two}/g, uixpbform_htmlEncode( imclass_two ) )
								  .replace(/{title_two}/g, uix_pb_pricing_col4_two_title ) 
								  .replace(/{period_two}/g, uix_pb_pricing_col4_two_period ) 
								  .replace(/{desc_two}/g, uix_pb_pricing_col4_two_desc )	
								  .replace(/{btnlabel_two}/g, uix_pb_pricing_col4_two_btn_label )	
								  .replace(/{currency_two}/g, uix_pb_pricing_col4_two_currency )
								  .replace(/{price_two}/g, uixpbform_floatval( uix_pb_pricing_col4_two_price ) )		  
								  .replace(/{btnurl_two}/g, encodeURI( uix_pb_pricing_col4_two_btn_link ) ) 
								  .replace(/{btncolor_two}/g, btncolor_two )
								  .replace(/{win_two}/g, win_two )
								  .replace(/{features_two}/g, uixpbform_html_listTran( uix_pb_pricing_col4_two_features, 'li' ) )	
											  
                                  .replace(/{imcolor_three}/g, uixpbform_htmlEncode( uix_pb_pricing_col4_three_emphasis_color ) )
                                  .replace(/{imclass_three}/g, uixpbform_htmlEncode( imclass_three ) )
								  .replace(/{title_three}/g, uix_pb_pricing_col4_three_title ) 
								  .replace(/{period_three}/g, uix_pb_pricing_col4_three_period ) 
								  .replace(/{desc_three}/g, uix_pb_pricing_col4_three_desc )	
								  .replace(/{btnlabel_three}/g, uix_pb_pricing_col4_three_btn_label )	
								  .replace(/{currency_three}/g, uix_pb_pricing_col4_three_currency )
								  .replace(/{price_three}/g, uixpbform_floatval( uix_pb_pricing_col4_three_price ) )		  
								  .replace(/{btnurl_three}/g, encodeURI( uix_pb_pricing_col4_three_btn_link ) )
								  .replace(/{btncolor_three}/g, btncolor_three )
								  .replace(/{win_three}/g, win_three )
								  .replace(/{features_three}/g, uixpbform_html_listTran( uix_pb_pricing_col4_three_features, 'li' ) )
				
                                  .replace(/{imcolor_four}/g, uixpbform_htmlEncode( uix_pb_pricing_col4_four_emphasis_color ) )
                                  .replace(/{imclass_four}/g, uixpbform_htmlEncode( imclass_four ) )
								  .replace(/{title_four}/g, uix_pb_pricing_col4_four_title ) 
								  .replace(/{period_four}/g, uix_pb_pricing_col4_four_period ) 
								  .replace(/{desc_four}/g, uix_pb_pricing_col4_four_desc )	
								  .replace(/{btnlabel_four}/g, uix_pb_pricing_col4_four_btn_label )	
								  .replace(/{currency_four}/g, uix_pb_pricing_col4_four_currency )
								  .replace(/{price_four}/g, uixpbform_floatval( uix_pb_pricing_col4_four_price ) )		  
								  .replace(/{btnurl_four}/g, encodeURI( uix_pb_pricing_col4_four_btn_link ) )
								  .replace(/{btncolor_four}/g, btncolor_four )
								  .replace(/{win_four}/g, win_four )
								  .replace(/{features_four}/g, uixpbform_html_listTran( uix_pb_pricing_col4_four_features, 'li' ) )
				
										   
								  .replace(/{heading}/g, _config_t )
								  .replace(/{desc}/g, _config_desc );		   
											  
								  
				
										   
										   
							
				$( "#<?php echo UixPageBuilder::fid( $colid, $sid, 'uix_pb_section_pricing2_temp' ); ?>" ).val( tempcode );
			}
			
			
			
			
		});
				 
	} ); 
} ) ( jQuery );
</script> 
    
    <?php	
}


