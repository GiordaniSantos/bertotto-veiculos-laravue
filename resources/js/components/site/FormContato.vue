<template>
    
    <div class="box-formulario">        
        
        <div class="formulario">
            
            <div class="title-form">
              <h1>Entre em Contato</h1>
            </div>
    
            <form action="#" method="post">
                     
    
                <span>
                    <input type="text" class="input" id="nome" name="nome" placeholder="Nome" autocomplete="off" required=""/>
                    <label for="nome"> <i class="fa-solid fa-user"></i> </label>
                </span>
    
                <span>
                    <input type="text" class="input" id="email" name="email" placeholder="E-mail" autocomplete="off" required=""/>
                    <label for="email"> <i class="fa-solid fa-envelope"></i> </label>
                </span>
    
                <span>
                    <input type="text" class="input" id="assunto" name="assunto" placeholder="Assunto" autocomplete="off" required=""/>
                    <label for="assunto"> <i class="fa-solid fa-phone"></i> </label>
                </span>
    
                <span>
                    <textarea type="text" class="textarea" id="mensagem" name="mensagem" rows="3" placeholder="Mensagem" autocomplete="off" required=""></textarea>
                    <label for="mensagem"> <i class="fa-solid fa-comment"></i> </label>
                </span>
    
                <div class="box-pulse">
                    <button type="submit" class="botao-pulse"><i class="fa-solid fa-share"></i> Enviar</button>
                </div>
    
            </form>
    
        </div>
    
    </div><!--Box Formulario-->  
</template>

<script>

</script>
