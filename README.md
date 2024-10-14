# Gerador de Avaliações Falsas para Produtos - Woocommerce

Essas avaliações podem ser usadas para preencher o conteúdo do seu site de teste ou para outros fins de desenvolvimento. Certifique-se de não utilizar avaliações falsas em ambientes de produção, pois isso pode afetar a credibilidade do seu site.

## Como Usar

Siga estas etapas para utilizar o script:

1. Adicione o plugin ao seu site Wordpress e ative-o.

2. No arquivo de configuração do seu site, adicione os dois arrays abaixo com os comentários e nomes de clientes que serão utilizados, recomendamos fazer os dois arrays bem grandes, para que os produtos fiquem com nomes e comentários bem diferentes.

## Código PHP

```php
define("CDH_CUSTOMER_NAMES_TO_FAKE_REVIEW", array(
	"Maria Silva",
	"João Santos",
	"Ana Oliveira",
	"Pedro Souza",
	"Julia Pereira",
	"Lucas Rodrigues",
));

define("CDH_REVIEW_COMMENTS", array(
	"Compraria novamente.",
	"Muito elegante e sofisticado.",
	"Perfeito para presentear alguém.",
	"Cheiro incrível!",
	"Embalegem cuidadosa.",
	"Produto 5 estrelas!",
));
```

3. Faça uma solicitação GET com o parâmetro `add_fake_review_cdh`. Exemplo: meusite.com.br/?add_fake_review_cdh
    **ALERTA: Se você tiver muitos produtos, isso pode tornar o seu site lento.**

5. Após adicionar as avaliações falsas, você verá uma mensagem em sua tela se teve sucesso ou não, após isso você pode remover o plugin caso já tenha finalizado.

## Observação

Certifique-se de entender o propósito deste script antes de utilizá-lo e evite usá-lo em ambientes de produção para manter a integridade de suas avaliações de produtos.