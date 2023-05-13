<template>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" v-for="titulo, key in titulos" :key="key" >{{titulo.titulo}}</th>
                <th v-if="visualizar || editar || excluir"></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="obj, chave in dadosFiltrados" :key="chave">
                <td v-for="valor, chaveValor in obj" :key="chaveValor">
                    <span v-if="titulos[chaveValor].tipo == 'text'">{{ valor }}</span>
                    <span v-if="titulos[chaveValor].tipo == 'data'">{{'...'+ valor }}</span>
                    <span v-if="titulos[chaveValor].tipo == 'boolean'">{{ '...' + valor }}</span>
                </td>
                <td>
                    <button v-if="visualizar" class="btn btn-outline-primary btn-sm" @click="setStore(obj)" ><a :href="urlVisualizar" @click="setStore(obj)">Visualizar</a></button>
                    <button v-if="editar" class="btn btn-outline-primary btn-sm">Atualizar</button>
                    <button v-if="excluir" class="btn btn-outline-danger btn-sm">Excluir</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: ['dados', 'titulos', 'editar', 'visualizar', 'excluir', 'urlVisualizar'],
        methods: {
            setStore(obj) {
                this.$store.state.item = obj;
                console.log(this.$store.state.item);
            }
        },  
        computed: {
            dadosFiltrados() {
                let campos = Object.keys(this.titulos);
                let dadosFiltrados = [];
                //console.log(campos);

                this.dados.map((item, chave) => {

                    let itemFiltrado = {};
                    campos.forEach(campo => {
                        itemFiltrado[campo] = item[campo]
                    })

                    dadosFiltrados.push(itemFiltrado);
                })
                
                return dadosFiltrados; //retorna um array de objetos para serem apresentados
            }
        }
    }
</script>
