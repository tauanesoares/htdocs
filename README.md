# Tabela brasileirão série A
  Para poder visualizar este site você precisará ter instalado xampp, postman e visual studio code.
Com os programas instalados siga o passo a passo:
1. Faça o download do projeto em zip
2. Entre na pasta "xampp", depois "htdocs" 
3. Exclua e cole o projeto ali dentro e depois extraia os arquivos do projeto
4. Abra o xampp e inicie o Apache.
5. Abra o Postman e coloque o link abaixo:
http://jsuol.com.br/c/monaco/utils/gestor/commons.js?&file=commons.uol.com.br/sistemas/esporte/modalidades/futebol/campeonatos/dados/2022/30/dados.json
6. Abra uma nova aba no Postman e coloque este link:
http://localhost/apifut/api.php?Comando=Classificacao
Obs: Ambos devem estar com o método GET
7. Abra o navegador
8. Digite http://localhost/views/index.php
Fim!

Obs: se der erro provavelmente é sua porta do localhost, pode tentar: http://localhost:8080/views/index.php ou http://localhost:80/views/index.php
e se for o caso, terá que mudar no arquivo do index a parte "CURLOPT_URL => 'http://localhost/apifut/api.php?Comando=Classificacao'," da linha 18 por
"CURLOPT_URL => 'http://localhost:8080/apifut/api.php?Comando=Classificacao'," ou "CURLOPT_URL => 'http://localhost:80/apifut/api.php?Comando=Classificacao',".
