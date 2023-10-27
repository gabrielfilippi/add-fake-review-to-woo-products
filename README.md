# Gerador de Avaliações Falsas para Produtos - Woocommerce

Este é um guia para utilizar um script PHP que permite adicionar avaliações falsas aos produtos em um site WordPress. Essas avaliações podem ser usadas para preencher o conteúdo do seu site de teste ou para outros fins de desenvolvimento. Certifique-se de não utilizar avaliações falsas em ambientes de produção, pois isso pode afetar a credibilidade do seu site.

## Como Usar

Siga estas etapas para utilizar o script:

1. Adicione o código no seu arquivo `functions.php` de um tema filho ou diretamente no seu tema.

2. Salve o documento.

3. Faça uma solicitação GET com o parâmetro `add_fake_review_cdh`.

    **ALERTA: Se você tiver muitos produtos, isso pode tornar o seu site lento.**
    *Você pode mudar a quantidade de avaliações geradas por produto modificando a linha: $numero_avaliacoes = rand(1, 5);*

5. Após adicionar as avaliações falsas, certifique-se de remover o código para evitar avaliações indesejadas em seu site de produção.

## Código PHP

```php
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
```

## Funções Auxiliares

Existem três funções auxiliares utilizadas no código:

1. `gerar_nomes_autores($quantidade)`: Gera uma lista de nomes de autores brasileiros não repetidos. Certifique-se de que a quantidade seja suficiente para as avaliações necessárias.

2. `gerar_comentario_aleatorio()`: Gera comentários aleatórios comuns que podem ser usados como avaliações.

3. `gerar_data_avaliacao()`: Gera datas de avaliação aleatórias em meses passados.

## Notas

Certifique-se de entender o propósito deste script antes de utilizá-lo e evite usá-lo em ambientes de produção para manter a integridade de suas avaliações de produtos.
