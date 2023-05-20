<?php
/**
 * Theme Options.
 *
 * Here, you can register Theme Options using the Carbon Fields library.
 *
 * @link    https://carbonfields.net/docs/containers-theme-options/
 *
 * @package WPEmergeCli
 */

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

$optionsPage = Container::make('theme_options', __('Theme Options', 'gaumap'))
                        ->set_page_file('app-theme-options.php')
                        ->add_tab(__('Branding | Thương hiệu', 'gaumap'), [
                            Field::make('image', 'logo' . currentLanguage(), __('Logo', 'gaumap'))
                                 ->set_width(25),
                            Field::make('image', 'logo_fixed' . currentLanguage(), __('Logo fixed', 'gaumap'))
                                 ->set_width(25),
                            Field::make('image', 'hinh_anh_mac_dinh' . currentLanguage(), __('Default image | Hình ảnh mặc định', 'gaumap'))
                                 ->set_width(25),
                        ])

                        ->add_tab(__('Contact | Liên hệ', 'gaumap'), [

                            Field::make('text', 'company' . currentLanguage(), __('Company | Công ty', 'gaumap'))
                                 ->set_default_value('43 SERVICES TRADING PRODUCTION LIMITED LIABILITY COMPANY'),

                            Field::make('textarea', 'address' . currentLanguage(), __('Address | Địa chỉ', 'gaumap'))
                                 ->set_default_value('43 Tran Tan Moi Street, Hoa Thuan Tay, Hai Chau District, Da Nang Province'),

                            Field::make('text', 'email' . currentLanguage(), __('Email', 'gaumap'))
                                 ->set_width(50)
                                 ->set_default_value('infor@43factory.coffee'),

                            Field::make('text', 'phone_number' . currentLanguage(), __('Phone number | Số điện thoại', 'gaumap'))
                                 ->set_width(50)
                                 ->set_default_value('0799 343 943'),

                            Field::make('complex', 'social_media' . currentLanguage(), __('Socials | Mạng xã hội', 'gaumap'))
                                 ->set_width(50)
                                 ->set_layout('tabbed-vertical')
                                 ->add_fields([
                                     Field::make('image', 'icon_social', __('Icon', 'gaumap')),
                                     Field::make('text', 'name_social', __('Name', 'gaumap')),
                                     Field::make('text', 'link_social', __('Link', 'gaumap')),
                                 ])->set_header_template('<% if (name_social) { %><%- name_social %><% } %>'),

                            Field::make('complex', 'payments' . currentLanguage(), __('Payments | Thanh Toán', 'gaumap'))
                                 ->set_width(50)
                                 ->set_layout('tabbed-vertical')
                                 ->add_fields([
                                     Field::make('image', 'icon_payment', __('Icon', 'gaumap')),
                                     Field::make('text', 'name_payment', __('Name', 'gaumap')),
                                 ])->set_header_template('<% if (name_payment) { %><%- name_payment %><% } %>'),

                            Field::make('textarea', 'certificate' . currentLanguage(), __('Certificate | Chứng nhận', 'gaumap')),

                            Field::make('image', 'bocongthuong' . currentLanguage(), __('Bộ công thương', 'gaumap'))
                                 ->set_width(20),
                            Field::make('text', 'link_bocongthuong' . currentLanguage(), __('Link', 'gaumap'))
                                 ->set_width(80),

                            Field::make('image', 'dmca' . currentLanguage(), __('DMCA protected', 'gaumap'))
                                 ->set_width(20),
                            Field::make('text', 'link_dmca' . currentLanguage(), __('Link', 'gaumap'))
                                 ->set_width(80),
                        ])

                        ->add_tab(__('Scripts', 'gaumap'), [
                            // Field::make('text', 'crb_google_maps_api_key', __('Google Maps API Key', 'app')),
                            Field::make('header_scripts', 'crb_header_script', __('Header Script', 'app')),
                            Field::make('footer_scripts', 'crb_footer_script', __('Footer Script', 'app')),
                        ]);

 // Philosophy page
Container::make('post_meta', __('Info page template:', 'gaumap'))
         ->set_context('carbon_fields_after_title')// normal, advanced, side or carbon_fields_after_title
         ->where( 'post_type', '=', 'page' )
         ->where( 'post_template', '=', 'page_templates/philosophy-page.php' )
         ->add_fields([
             Field::make('complex', 'philosophy_content_blocks', __('', 'gaumap'))
                  ->set_layout('tabbed-vertical')
                  ->add_fields([
                      Field::make('radio_image', 'content_blocks_display_type', __('Display type | Kiểu hiển thị', 'gaumap'))
                           ->set_options([
                               'cbs-1' => get_site_url() . '/wp-content/themes/mooms_dev/resources/images/philosophy-content-block-1.png',
                               'cbs-2' => get_site_url() . '/wp-content/themes/mooms_dev/resources/images/philosophy-content-block-2.png',
                               'cbs-3' => get_site_url() . '/wp-content/themes/mooms_dev/resources/images/philosophy-content-block-3.png',
                               'cbs-4' => get_site_url() . '/wp-content/themes/mooms_dev/resources/images/philosophy-content-block-4.png',
                           ]),

                      Field::make('image', 'img_cbs', __('Image | Hình ảnh', 'gaumap'))
                           ->set_conditional_logic([
                               'relation' => 'AND',
                               ['field' => 'content_blocks_display_type', 'value' => 'cbs-4', 'compare' => '=',],
                           ]),

                      Field::make('text', 'title_cbs', __('Title | Tiêu đề', 'gaumap'))
                          ->set_conditional_logic([
                              'relation' => 'AND',
                              ['field' => 'content_blocks_display_type', 'value' => 'cbs-4', 'compare' => 'EXCLUDES',],
                          ]),

                      Field::make('complex', 'expanded_content_cbs_3', __('Expanded content | Nội dung mở rộng', 'gaumap'))
                           ->set_layout('tabbed-vertical')
                           ->set_conditional_logic([
                               'relation' => 'AND',
                               ['field' => 'content_blocks_display_type', 'value' => 'cbs-3', 'compare' => '=',],
                           ])
                           ->add_fields([
                               Field::make('image', 'img_expanded', __('Image | Hình ảnh', 'gaumap')),
                               Field::make('text', 'name_expanded', __('Name | Tên', 'gaumap')),
                               Field::make('text', 'position_expanded', __('Position | Vị trí', 'gaumap')),
                           ])->set_header_template('<% if (name_expanded) { %><%- name_expanded %><% } %>'),

                      Field::make('rich_text', 'content_cbs', __('Content | Nội dung', 'gaumap'))
                          ->set_conditional_logic([
                              'relation' => 'AND',
                              ['field' => 'content_blocks_display_type', 'value' => ['cbs-4', 'cbs-2'], 'compare' => 'EXCLUDES',],
                          ]),

                      Field::make('complex', 'expanded_content_cbs_1', __('Expanded content | Nội dung mở rộng', 'gaumap'))
                           ->set_layout('tabbed-vertical')
                           ->set_conditional_logic([
                               'relation' => 'AND',
                               ['field' => 'content_blocks_display_type', 'value' => 'cbs-1', 'compare' => '=',],
                           ])
                           ->add_fields([
                               Field::make('text', 'title_expanded', __('Title | Tiêu đề', 'gaumap')),
                               Field::make('rich_text', 'desc_expanded', __('Desc | Mô tả', 'gaumap')),
                           ])->set_header_template('<% if (title_expanded) { %><%- title_expanded %><% } %>'),

                      Field::make('complex', 'expanded_content_cbs_2', __('Expanded content | Nội dung mở rộng', 'gaumap'))
                           ->set_layout('tabbed-vertical')
                           ->set_conditional_logic([
                               'relation' => 'AND',
                               ['field' => 'content_blocks_display_type', 'value' => 'cbs-2', 'compare' => '=',],
                           ])
                           ->add_fields([
                               Field::make('text', 'title_expanded', __('Title | Tiêu đề', 'gaumap')),
                               Field::make('rich_text', 'desc_expanded', __('Desc | Mô tả', 'gaumap')),
                           ])->set_header_template('<% if (title_expanded) { %><%- title_expanded %><% } %>'),


                  ])->set_header_template('<% if (title_cbs) { %><%- title_cbs %><% } %>'),
         ]);
