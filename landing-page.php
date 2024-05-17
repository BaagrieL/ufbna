<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="components/header.css">
    <link rel="stylesheet" href="components/nav.css">
    <link rel="stylesheet" href="components/footer.css">
    <link rel="stylesheet" href="./style/landingpage.css">
    <title>Universidade UFBNA</title>
</head>
<body>

    <?php include_once './components/header.php' ?>

    <main>
        <section id="historia">
            <h2>Nossa História</h2>
            <p>Bem-vindo à Universidade UFBNA, onde a busca pelo conhecimento e pela excelência acadêmica é uma constante. No entanto, enfrentamos um desafio significativo em relação aos nossos frequentes eventos científicos realizados em nossos Campi. A recepção dos artigos a serem apresentados nestes eventos tem sido dificultosa e ineficiente, demandando um esforço considerável tanto dos autores dos artigos quanto dos professores encarregados de avaliá-los. Estamos comprometidos em superar esse obstáculo e aprimorar o processo de submissão e avaliação, garantindo que a qualidade do conteúdo acadêmico seja valorizada sem sobrecarregar os envolvidos. Junte-se a nós nesta jornada rumo a uma experiência mais eficiente e enriquecedora para todos os participantes.</p>
        </section>
        <section id="missao">
            <h2>Nossa Missão</h2>
            <p>Na UFBNA, nossa missão é simplificar e aprimorar o processo de recepção e avaliação de artigos científicos, proporcionando uma experiência eficiente e colaborativa para autores e avaliadores.</p>
        </section>
        <section id="valores">
            <h2>Nossos Valores</h2>
            <ul>
                <li><span class="value-icon">🌟</span> Excelência: Buscamos a excelência na organização e execução de eventos científicos;</li>
                <li><span class="value-icon">🤝</span> Colaboração: Valorizamos a colaboração entre autores, avaliadores e organizadores para promover avanços na pesquisa;</li>
                <li><span class="value-icon">⏱️</span> Eficiência: Comprometemo-nos a tornar o processo de recepção e avaliação de artigos mais eficiente e acessível;</li>
                <li><span class="value-icon">💡</span> Inovação: Estamos abertos à inovação e à adoção de novas práticas para aprimorar a experiência dos participantes.</li>
            </ul>
        </section>
        <section id="cursos">
            <h2>Nossos Cursos</h2>
            <ul>
                <li>Engenharia de Software</li>
                <li>Ciência de Dados</li>
                <li>Design Gráfico</li>
            </ul>
        </section>
        <section id="depoimentos">
            <h2>Depoimentos</h2>
            <div class="testimonial">
                <p>"A UFBNA mudou minha vida! Os professores são incríveis e o ambiente de aprendizado é inspirador."</p>
                <span>- João Silva, Aluno de Engenharia</span>
            </div>
        </section>
        <section id="eventos">
            <h2>Próximos Eventos</h2>
            <ul>
                <li>Conferência de Inteligência Artificial (Data: 15/06/2024)</li>
                <li>Workshop de Empreendedorismo (Data: 20/06/2024)</li>
            </ul>
        </section>
    </main>
    
    <?php include_once './components/footer.php' ?>
</body>
</html>
