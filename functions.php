<?php

/**
 * Add in your functions.php child theme ou directy in your theme
 * 
 * Save the document and make GET request with add_fake_review_cdh parameter
 * 
 * 
 * ALERT: With you have too many products this make you site slow.
 * 
 * After add reviews delete the code!
*/

add_action('init', 'adicionar_avaliacoes_perfumaria');
// Função para adicionar avaliações aos produtos de perfumaria
function adicionar_avaliacoes_perfumaria() {
	if(isset($_GET["add_fake_review_cdh"])){
		$produtos_perfumaria = get_posts(array('post_type' => 'product', 'numberposts' => -1));

		if ($produtos_perfumaria) {
			$nomes_autores = gerar_nomes_autores(350); // Gere 350 nomes de autores únicos

			foreach ($produtos_perfumaria as $produto) {
				$numero_avaliacoes = rand(1, 5); // Adicionar de 1 a 5 avaliações em cada produto

				for ($i = 0; $i < $numero_avaliacoes; $i++) {
					$autor = array_shift($nomes_autores); // Obtenha o próximo autor da lista
					$avaliacao = array(
						'comment_post_ID' => $produto->ID,
						'comment_author' => $autor,
						'comment_content' => gerar_comentario_aleatorio(),
						'comment_date' => gerar_data_avaliacao(),
						'comment_approved' => 1, // Aprovar automaticamente a avaliação
						'comment_meta' => array('rating' => rand(4, 5), 'verified' => 1), // Avalie com 4 ou 5 estrelas
						'verified' => 1,
					);

					wp_insert_comment($avaliacao);
				}
			}
		}
	}
}

// Função para gerar nomes de autores brasileiros não repetidos
function gerar_nomes_autores($quantidade) {
	// Lista de 150 nomes brasileiros
	$nomes_br = array(
		"Maria Silva",
		"João Santos",
		"Ana Oliveira",
		"Pedro Souza",
		"Julia Pereira",
		"Lucas Rodrigues",
		"Larissa Almeida",
		"Gabriel Fernandes",
		"Mariana Gonçalves",
		"Gustavo Lima",
		"Isabela Costa",
		"Rafael Barbosa",
		"Camila Ribeiro",
		"Enzo Ferreira",
		"Laura Cardoso",
		"Matheus Rocha",
		"Sophia Carvalho",
		"Daniel Martins",
		"Manuela Correia",
		"Leonardo Castro",
		"Valentina Santos",
		"Eduardo Nunes",
		"Alice Mendes",
		"Thiago Carneiro",
		"Lívia Gomes",
		"Henrique Sousa",
		"Lara Vieira",
		"Bruno Oliveira",
		"Clara Silva",
		"Vinícius Santos",
		"Beatriz Rodrigues",
		"Cauã Fernandes",
		"Ana Luiza Almeida",
		"Ricardo Ferreira",
		"Heloísa Lima",
		"Alexandre Pereira",
		"Cecília Barbosa",
		"Felipe Ribeiro",
		"Sophie Gonçalves",
		"Samuel Costa",
		"Amanda Cardoso",
		"João Pedro Rocha",
		"Valentina Correia",
		"Davi Martins",
		"Antônia Carvalho",
		"Benjamin Castro",
		"Elisa Santos",
		"Luiz Carneiro",
		"Esther Mendes",
		"Luiz Gustavo Ribeiro",
		"Eloá Gomes",
		"Rodrigo Silva",
		"Clara Barbosa",
		"Breno Lima",
		"Antônia Rodrigues",
		"Miguel Almeida",
		"Lorena Ferreira",
		"Noah Pereira",
		"Isabella Cardoso",
		"Lucas Carvalho",
		"Lívia Sousa",
		"Guilherme Correia",
		"Melissa Martins",
		"Davi Ribeiro",
		"Antonella Gonçalves",
		"Francisco Lima",
		"Luísa Oliveira",
		"Giovanni Castro",
		"Lavinia Santos",
		"João Lucas Fernandes",
		"Stella Vieira",
		"Enzo Barbosa",
		"Maria Clara Silva",
		"Augusto Rocha",
		"Eloísa Carneiro",
		"Renan Costa",
		"Elisa Carvalho",
		"Nicolas Ribeiro",
		"Isis Cardoso",
		"Raul Martins",
		"Rafaela Ferreira",
		"Carlos Eduardo Almeida",
		"Clara Barbosa",
		"Luiz Felipe Lima",
		"Valentina Rodrigues",
		"Vicente Gomes",
		"Fernanda Sousa",
		"Matias Correia",
		"Larissa Mendes",
		"Henrique Almeida",
		"Eduarda Rocha",
		"Lorena Silva",
		"Lucas Carneiro",
		"Catarina Martins",
		"Thiago Ribeiro",
		"Lavinia Carvalho",
		"Rafael Correia",
		"Sofia Santos",
		"Bruno Barbosa",
		"Lara Lima",
		"Mateus Fernandes",
		"Ayla Oliveira",
		"Caio Cardoso",
		"Ana Luiza Carvalho",
		"Daniel Martins",
		"Beatriz Rodrigues",
		"Gabriel Almeida",
		"Larissa Ferreira",
		"Lucas Ribeiro",
		"Camila Gonçalves",
		"Luis Fernando Lima",
		"Valentina Pereira",
		"Eduardo Gomes",
		"Larissa Carneiro",
		"Guilherme Martins",
		"Isabella Barbosa",
		"João Pedro Correia",
		"Marina Cardoso",
		"Vitor Carvalho",
		"Isis Sousa",
		"Rafael Correia",
		"Clara Santos",
		"Vicente Barbosa",
		"Antonia Lima",
		"Sophie Rodrigues",
		"Carlos Eduardo Almeida",
		"Renata Rocha",
		"Lucas Oliveira",
		"Isabella Mendes",
		"Gustavo Ribeiro",
		"Mariana Gomes",
		"Eduardo Martins",
		"Ana Luiza Carvalho",
		"Leonardo Castro",
		"Valentina Santos",
		"Vitoria Nunes",
		"Felipe Cardoso",
		"Clara Almeida",
		"Enzo Barbosa",
		"Luisa Lima",
		"Miguel Fernandes",
		"Sophie Oliveira",
		"Samuel Carneiro",
		"Amanda Martins",
	);

	// Embaralhe a lista para garantir aleatoriedade
	shuffle($nomes_br);

	// Use array_slice para obter o número necessário de nomes únicos
	return array_slice($nomes_br, 0, $quantidade);
}

// Função para gerar comentários aleatórios
function gerar_comentario_aleatorio() {
	$comentarios_comuns = array(
		"Ótimo produto!",
		"Cheiro maravilhoso.",
		"Recomendo a todos.",
		"Entrega rápida e eficiente.",
		"Minha fragrância favorita.",
		"Excelente compra!",
		"Qualidade excepcional.",
		"Chegou em perfeitas condições.",
		"Melhor perfume que já usei.",
		"Estou muito satisfeito.",
		"Produto de alta qualidade.",
		"Perfeito para todas as ocasiões.",
		"Superou minhas expectativas.",
		"Fragrância duradoura.",
		"Preço justo.",
		"Compraria novamente.",
		"Muito elegante e sofisticado.",
		"Perfeito para presentear alguém.",
		"Cheiro incrível!",
		"Embalegem cuidadosa.",
		"Produto 5 estrelas!",
	);

	$comentario_aleatorio = $comentarios_comuns[array_rand($comentarios_comuns)];

	return $comentario_aleatorio;
}

// Função para gerar datas de avaliação aleatórias em meses passados
function gerar_data_avaliacao() {
	$mes_passado = strtotime('-1 month', strtotime('27-10-2023'));
	$data_avaliacao = date('Y-m-d H:i:s', mt_rand($mes_passado, strtotime('27-10-2023')));

	return $data_avaliacao;
}