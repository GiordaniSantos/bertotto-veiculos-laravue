<footer>
    <div class="row container-fluid borda-top">
        <div class="justify-content-beetween">
            <div class="col-sm-4 col-lg-3 col-xl-3">
                <h5 style="margin-bottom: 35px;">Endereço</h5>
                <ul class="list-inline">
                    <li class="cor-texto-endereco">Av. Coronel Theodomiro Porto da Fonseca, 2009</li>
                    <li class="cor-texto-endereco">Capão da Cruz</li>
                    <li class="cor-texto-endereco">Sapucaia do Sul - RS, 93230-440</li>
                </ul>
            </div>
            <div class="col-sm-4 col-lg-3 col-xl-3">
                <h5 style="margin-bottom: 23px;">Contatos</h5>
                <dl class="list-contatos" style="margin-bottom: 0;">
                    <dt class="cor-texto-endereco" style="margin-right: 7px;">Telefone:</dt>
                    <dd><a href="" class="link-contato">51 9800-7554</a></dd>
                </dl>
                <dl class="list-contatos">
                    <dt class="cor-texto-endereco" style="margin-right: 7px;">Email:</dt>
                    <dd><a href="" class="link-contato">bertotto.veic@gmail.com</a></dd>
                </dl>
                <ul class="list-inline list-contatos">
                    <li><a href="" ><img src="{{url('/')}}/images/facebook.png" alt="Facebook" width="44" class="efeito-midia"></a></li>
                    <li><a href=""><img src="{{url('/')}}/images/instagram.png" alt="Facebook" width="44" class="efeito-midia"></a></li>
                </ul>
            </div>
            <div class="col-sm-4 col-lg-3 col-xl-3">
                <img src="{{url('/')}}/images/logo2.png" height="188px" alt="BV" style="height: 188px;">
            </div>
        </div>
    </div>
    <div>
    <div class="footer-2 rodape-resp">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                <p class="float-start">&copy; {{ config('app.name', 'Laravel') }} {{ date('Y') }}</p>
                </div>
                <div class="col-6">
                <p class="float-end">Desenvolvido por <a href="https://www.linkedin.com/in/giordani-da-silveira-dos-santos-1b8168182/" class="link-contato" target="_blank">Giordani</a></p>
                </div>
            </div>
        </div>
    </div>
    </div>
</footer>