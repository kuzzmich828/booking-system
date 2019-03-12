<?php
//defining the filter that will be used to select posts by 'post formats'
function add_post_formats_filter_to_post_administration(){

    //execute only on the 'post' content type
    global $post_type;
    if($post_type == 'booking'){

        $post_formats_args = array(
            'show_option_all'   => 'All Post formats',
            'orderby'           => 'NAME',
            'order'             => 'ASC',
            'name'              => 'post_format_admin_filter',
            'taxonomy'          => 'post_format'
        );

        //if we have a post format already selected, ensure that its value is set to be selected
        if(isset($_GET['post_format_admin_filter'])){
            $post_formats_args['selected'] = sanitize_text_field($_GET['post_format_admin_filter']);
        }

        ?>
        <select name="post_format_admin_filter" id="post_format_admin_filter" class="postform">
            <option>asfgdsg</option>
            <option>acvncv</option>
            <option>hdfhdfjfg</option>
        </select>
<?php

    }
}
add_action('restrict_manage_posts','add_post_formats_filter_to_post_administration');

function add_post_format_filter_to_posts($query){

    global $post_type, $pagenow;

    //if we are currently on the edit screen of the post type listings
    if($pagenow == 'edit.php' && $post_type == 'post'){
        if(isset($_GET['post_format_admin_filter'])){

            //get the desired post format
            $post_format = sanitize_text_field($_GET['post_format_admin_filter']);
            //if the post format is not 0 (which means all)
            if($post_format != 0){

                $query->query_vars['tax_query'] = array(
                    array(
                        'taxonomy'  => 'post_format',
                        'field'     => 'ID',
                        'terms'     => array($post_format)
                    )
                );

            }
        }
    }
}
add_action('pre_get_posts','add_post_format_filter_to_posts');
