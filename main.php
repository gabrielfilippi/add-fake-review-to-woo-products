<?php
/**
 * Plugin Name: CodeHive - Fake Product Review Generator for Woocommerce
 * Plugin URI: https://github.com/gabrielfilippi/add-fake-review-to-woo-products/
 * Description: Add fake reviews for woocommerce products.
 * Version: 2.0.0
 * Author: CodeHive
 * Author URI: https://codehive.com.br
 * 
 */

/**
 * Function to add fake reviews to Woocommerce products. It is necessary to make a GET request using the "add_fake_review_cdh" parameter
 * 
 * @since 14/10/20204
 */
add_action('init', 'cdh_add_fakes_reviews');
function cdh_add_fakes_reviews() {
	if(isset($_GET["add_fake_review_cdh"])){
		$products_to_review = get_posts(array(
            'post_type' => 'product',
            'numberposts' => -1,
            'meta_query' => array(
                array(
                    'key' => '_wc_average_rating',
                    'value' => 0,
                    'compare' => '=',
                )
            )
        ));

		if ($products_to_review) {
			$customer_names = cdh_get_fake_customer_names();

			$reviews_index = 0;
			foreach ($products_to_review as $product) {
				$numero_avaliacoes = rand(1, 3); // Add 1 to 3 reviews to each product

				for ($i = 0; $i < $numero_avaliacoes; $i++) {
					$customer_name = array_shift($customer_names); // Get the next author from the list
					if(!$customer_name){
						add_action('admin_notices', function() {
							cdh_add_fake_review_notice('error', 'Você precisa definir o array de nomes de clientes em wp-config.php!');
						});

						break 2;
					}

					$review_comment = cdh_get_fake_review_comment();
					if(!$review_comment){
						add_action('admin_notices', function() {
							cdh_add_fake_review_notice('error', 'Você precisa definir o array de comentários fakes em wp-config.php!');
						});

						break 2;
					}

					$avaliacao = array(
						'comment_post_ID' => $product->ID,
						'comment_author' => $customer_name,
						'comment_content' => $review_comment,
						'comment_date' => cdh_get_fake_review_date(),
						'comment_approved' => 1, // Automatically approve the assessment
						'comment_meta' => array('rating' => rand(4, 5), 'verified' => 1), // Rate with 4 or 5 stars
						'verified' => 1,
					);

					wp_insert_comment($avaliacao);
					$reviews_index++;
				}
			}

			if($reviews_index > 0){
				add_action('admin_notices', function() use ($reviews_index) {
					cdh_add_fake_review_notice('success', $reviews_index . ' avaliações foram adicionadas com sucesso!');
				});
			}else{
				add_action('admin_notices', function() {
					cdh_add_fake_review_notice('error', 'Nenhuma avaliação foi adicionada');
				});
			}
		}else{
			add_action('admin_notices', function() {
				cdh_add_fake_review_notice('warning', 'Não há nenhum produto que ainda não tenha avaliação para ser avaliado.');
			});
		}
	}
}

/**
 * Returns the names of customers that will be used for evaluations
 * 
 * @since 14/10/2024
 */
function cdh_get_fake_customer_names() {
	$customer_names = array();

	if(defined("CDH_CUSTOMER_NAMES_TO_FAKE_REVIEW")){
		$customer_names = CDH_CUSTOMER_NAMES_TO_FAKE_REVIEW;
	}

	// Shuffle the list to ensure randomness
	shuffle($customer_names);

	return $customer_names;
}

/**
 * Returns the comment to be used for a review
 * 
 * @since 14/10/2024
 */
function cdh_get_fake_review_comment() {
	$review_comments = array();

	if(defined("CDH_REVIEW_COMMENTS")){
		$review_comments = CDH_REVIEW_COMMENTS;
		return $review_comments[array_rand($review_comments)];
	}

	return $review_comments;
}

/**
 * Function to generate random assessment dates in past months
 * 
 * @since 14/10/2024
 */
function cdh_get_fake_review_date() {
    // Define o timestamp atual
    $data_atual = time();
    // Calcula o timestamp de 6 meses atrás
    $seis_meses_atras = strtotime('-6 months', $data_atual);
    
    // Gera uma data aleatória entre 6 meses atrás e agora
    $data_avaliacao = date('Y-m-d H:i:s', mt_rand($seis_meses_atras, $data_atual));

    return $data_avaliacao;
}

/**
 * Function to show notice
 * 
 * @since 14/10/2024
 */
function cdh_add_fake_review_notice($type, $message) {
	$classes_notice = 'notice notice-' . $type . ' is-dismissible';
    echo '<div class="' . esc_attr($classes_notice) . '">
            <p>' . esc_html($message) . '</p>
          </div>';
}