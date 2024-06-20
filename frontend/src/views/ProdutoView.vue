<template>
    <div class="content">
        <div id="area">

            <template v-if="template === 'listar'">
                <div class="d-flex justify-content-between areaHeader">
                    <div class="text-start">
                        <span>PRODUTOS</span>
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-headArea" title="Novo produto"
                            @click="(this.template = 'salvar', this.produto = {})"><i
                                class="fa-solid fa-plus"></i></button>
                    </div>
                </div>

                <div class="mb-2">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="searchProduto" placeholder="Pesquisar nome..."
                            v-model="search">
                        <label for="searchProduto">Pesquisar nome...</label>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-opcoes search-button" @click="loadProdutos()"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>

                <div class="mb-2" v-if="(produtos.length > 0)">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">CÓDIGO</th>
                                <th scope="col">NOME</th>
                                <th scope="col">CATEGORIA</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(produto, index) in produtos" :key="index">
                                <td>{{ produto.codigo }}</td>
                                <td>{{ produto.nome }}</td>
                                <td>{{ produto.categoria.nome }}</td>
                                <td>
                                    <button class="btn btn-sm btn-opcoes me-2"
                                        @click="(this.template = 'visualizar', this.loadProduto(produto.id))"
                                        title="Visualizar"><i
                                            class="fa-solid fa-arrow-up-right-from-square"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else>
                    <span class="lenght0">Nenhum registro localizado.</span>
                </div>
            </template>

            <template v-if="template === 'salvar'">
                <div class="d-flex justify-content-between areaHeader">
                    <div class="text-start">
                        <span>PRODUTO</span>
                    </div>
                </div>
                <div class="card">
                    <h5 class="card-header">{{ produto.id ? `Editando... (Id. ${produto.id})` : 'Novo produto...' }}
                    </h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-lg-6 mb-2">
                                <div class="form-floating">
                                    <select class="form-select" :class="errors.categoria_id ? 'is-invalid' : ''"
                                        id="validationServerCategoria"
                                        aria-describedby="validationServerCategoriaFeedback"
                                        v-model="produto.categoria_id">
                                        <option disabled selected>Selecione ...</option>
                                        <option v-for="(categoria, index) in categorias" :key="index"
                                            :value="categoria.id">{{ categoria.nome }}</option>
                                    </select>
                                    <label for="validationServerCategoria">Categoria</label>
                                    <div v-if="errors.categoria_id" id="validationServerCategoriaFeedback"
                                        class="invalid-feedback text-start">{{
                errors.categoria_id[0] }}</div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control" :class="errors.codigo ? 'is-invalid' : ''"
                                        id="validationServerCodigo" aria-describedby="validationServerCodigoFeedback"
                                        placeholder="Codigo" v-model="produto.codigo">
                                    <label for="validationServerCodigo">Codigo</label>
                                    <div v-if="errors.codigo" id="validationServerCodigofeedback"
                                        class="invalid-feedback text-start">
                                        {{ errors.codigo[0] }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control" :class="errors.nome ? 'is-invalid' : ''"
                                        id="validationServerNome" aria-describedby="validationServerNomeFeedback"
                                        placeholder="Nome" v-model="produto.nome">
                                    <label for="validationServerNome">Nome *</label>
                                    <div v-if="errors.nome" id="validationServerNomeFeedback"
                                        class="invalid-feedback text-start">{{ errors.nome[0] }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="form-floating">
                                    <textarea class="form-control" :class="errors.descricao ? 'is-invalid' : ''"
                                        id="validationServerDescricao"
                                        aria-describedby="validationServerDescricaoFeedback"
                                        v-model="produto.descricao"></textarea>
                                    <label for="validationServerDescricao">Descrição *</label>
                                    <div v-if="errors.descricao" id="validationServerDescricaoFeedback"
                                        class="invalid-feedback text-start">{{ errors.descricao[0] }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-lg-4 mb-2">
                                <div class="form-floating">
                                    <div class="form-check text-start">
                                        <input class="form-check-input" type="checkbox" false-value="0" true-value="1"
                                            id="flexCheckDefault" v-model="produto.descontinuado">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            descontinuado
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="button" class="btn btn-cancel me-2"
                            @click="(produto.id ? (this.template = 'visualizar', this.loadProduto(produto.id)) : (this.template = 'listar', this.produto = {}), this.loadProdutos())">Cancelar</button>
                        <button class="btn btn-acao" type="button"
                            @click="saveProduto(produto.id ? produto.id : null)">Salvar</button>
                    </div>
                </div>
                <div>
                    <span class="obgField">* Campo obrigatório.</span>
                </div>
            </template>

            <template v-if="template === 'visualizar'">
                <div class="d-flex justify-content-between areaHeader">
                    <div class="text-start">
                        <span>PRODUTO</span>
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-headArea me-2" title="Lista de produtos"
                            @click="(this.template = 'listar', this.loadProdutos())"><i
                                class="fa-solid fa-users"></i></button>
                    </div>
                </div>
                <div class="">
                    <div class="subArea">
                        <div class="title-sub-area">
                            <span>Informações</span>
                            <div class="d-flex justify-content-end m-2">
                                <button class="btn btn-sm btn-headSubArea"
                                    @click="(this.template = 'salvar', this.loadProduto(produto.id))" title="Editar"><i
                                        class="fa-solid fa-user-pen"></i></button>
                                <button class="btn btn-sm btn-delete"
                                    @click="(this.template = 'excluir-produto', this.loadProduto(produto.id))"
                                    title="Excluir"><i class="fa-regular fa-trash-can"></i></button>
                            </div>
                        </div>
                        <div class="tupla">
                            <div class="field">
                                Código
                            </div>
                            <div class="data">
                                {{ this.produto.codigo ? this.produto.codigo : '---' }}
                            </div>
                        </div>
                        <div class="tupla">
                            <div class="field">
                                Categoria
                            </div>
                            <div class="data">
                                {{ this.produto.categoria_id }}
                            </div>
                        </div>
                        <div class="tupla">
                            <div class="field">
                                Nome
                            </div>
                            <div class="data">
                                {{ this.produto.nome }}
                            </div>
                        </div>
                        <div class="tupla">
                            <div class="field">
                                Descrição
                            </div>
                            <div class="data">
                                {{ this.produto.descricao }}
                            </div>
                        </div>
                        <div class="tupla">
                            <div class="field">
                                Criado em
                            </div>
                            <div class="data">
                                {{ this.produto.created_at ? formatDate(this.produto.created_at) : '' }}
                            </div>
                        </div>
                        <div class="tupla">
                            <div class="field">
                                Atualizado em
                            </div>
                            <div class="data">
                                {{ this.produto.updated_at ? formatDate(this.produto.updated_at) : '' }}
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <template v-if="template === 'excluir-produto'">
                <div class="d-flex justify-content-between areaHeader">
                    <div class="text-start">
                        <span>PRODUTO</span>
                    </div>
                </div>
                <div class="box show">
                    <div class="fs-4 pb-2 mb-4 border-bottom border-dark">
                        <span>Atenção</span>
                    </div>
                    <div style="margin: 10px;">
                        Confirma a exclusão do(a) produto "{{ this.produto.nome }}" ?
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-cancel"
                            @click="(this.template = 'visualizar', this.loadProduto(this.produto.id))">Cancelar</button>
                        <button type="button" class="btn btn-delete"
                            @click="destroyProduto(this.produto.id)">Excluir</button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
import AbstractMixin from '@/mixins/AbstractMixin';
import http from '@/services/http.js';

export default {
    name: 'ProdutoView',

    mixins: [AbstractMixin],

    data() {
        return {
            template: 'listar',
            produtos: {},
            produto: {},
            categorias: [],
            search: '',
            errors: []
        };
    },

    mounted() {
        this.loadCategorias(),
            this.loadProdutos()
    },

    methods: {

        async saveProduto(id) {
            this.SET_LOADER({ 'active': true, 'text': 'Salvando dados...' })

            try {
                let metodo = id ? 'patch' : 'post'
                let urlSelected = id ? `${process.env.VUE_APP_BACKEND_URL}/produto/${id}` : `${process.env.VUE_APP_BACKEND_URL}/produto`

                let response = await http({ method: metodo, url: urlSelected, data: this.produto })

                if (response.status == 200 || response.status == 201) {
                    this.PUSH_NOTIFICATION({
                        type: 'sucesso',
                        message: response.data.msg
                    })
                }
                this.errors = []
                this.loadProdutos(),
                    this.template = 'listar',
                    this.produto = {}
            }
            catch (error) {
                if (error?.response?.status === 422) {
                    this.PUSH_NOTIFICATION({
                        type: 'erro',
                        message: 'Conteúdo não processável. Verifique as regras de validação.'
                    })
                    this.errors = error.response.data.errors
                }
            }
            finally {
                this.SET_LOADER({ 'active': false, 'text': '' })
            }
        },

        async loadProduto(id) {

            let url = `${process.env.VUE_APP_BACKEND_URL}/produto/${id}`

            this.getDadosApi(url)
                .then((result) => {
                    this.produto = result.data
                })
        },

        async destroyProduto(id) {

            this.SET_LOADER({ 'active': true, 'text': 'Excluindo dados...' })

            try {
                let url = `${process.env.VUE_APP_BACKEND_URL}/produto/${id}`
                let response = await http.delete(url)

                if (response.status == '200') {
                    this.PUSH_NOTIFICATION({
                        type: 'sucesso',
                        message: response.data.msg
                    })
                    this.errors = []
                    this.loadProdutos(),
                    this.template = 'listar'
                }
            }
            catch (error) {
                if (error?.response?.status) {
                    if (error?.response?.status == '404') {
                        this.PUSH_NOTIFICATION({
                            type: 'informe',
                            message: 'Nenhum registro foi localizado.'
                        })
                    }
                    this.errors = error.response.data.errors
                }
            }
            finally {
                this.SET_LOADER({ 'active': false, 'text': '' })
            }
        },

        loadProdutos() {

            let url = process.env.VUE_APP_BACKEND_URL + '/produto?with=categoria'

            if (this.search) {
                url = url + '&filtro=nome:like:%' + this.search + '%'
            }

            this.getDadosApi(url)
                .then((result) => {
                    this.produtos = result.data
                })
        },

        async loadCategorias() {

            let url = `${process.env.VUE_APP_BACKEND_URL}/categoria`

            this.getDadosApi(url)
                .then((result) => {
                    this.categorias = result.data
                })

        },
    },
};
</script>