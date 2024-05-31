<template>
    <div class="content">
        <div id="area">

            <template v-if="template === 'listar'">
                <div class="d-flex justify-content-between areaHeader">
                    <div class="text-start">
                        <span>CLIENTES</span>
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-headArea" title="Novo cliente"
                            @click="(this.template = 'salvar', this.cliente = {})"><i
                                class="fa-solid fa-plus"></i></button>
                    </div>
                </div>

                <div class="mb-2">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="searchCliente" placeholder="Pesquisar nome..."
                            v-model="search">
                        <label for="searchCliente">Pesquisar nome...</label>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-opcoes search-button" @click="loadClientes()"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>

                <div class="mb-2" v-if="(clientes.length > 0)">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">NOME</th>
                                <th scope="col">Tel/Cel</th>
                                <th scope="col">Email</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(cliente, index) in clientes" :key="index">
                                <td>{{ cliente.id }}</td>
                                <td>{{ cliente.nome }}</td>
                                <td>{{ cliente.tel_cel }}</td>
                                <td>{{ cliente.email }}</td>
                                <td>
                                    <button class="btn btn-sm btn-opcoes me-2"
                                        @click="(this.template = 'visualizar', this.loadCliente(cliente.id), this.loadEnderecos(cliente.id))"
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
                        <span>CLIENTE</span>
                    </div>
                </div>
                <div class="card">
                    <h5 class="card-header">{{ cliente.id ? `Editando... (Id. ${cliente.id})` : 'Novo cliente...' }}
                    </h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 mb-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control" :class="errors.nome ? 'is-invalid' : ''"
                                        id="validationServerNome" aria-describedby="validationServerNomeFeedback"
                                        placeholder="Nome" v-model="cliente.nome">
                                    <label for="validationServerNome">Nome *</label>
                                    <div v-if="errors.nome" id="validationServerNomeFeedback"
                                        class="invalid-feedback text-start">{{ errors.nome[0] }}</div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-4 mb-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control" :class="errors.cnpj_cpf ? 'is-invalid' : ''"
                                        id="validationServerCpfCnpj" aria-describedby="validationServerCpfCnpjFeedback"
                                        placeholder="CPF / CNPJ" v-model="cliente.cnpj_cpf">
                                    <label for="validationServerCpfCnpj">CPF / CNPJ *</label>
                                    <div v-if="errors.cnpj_cpf" id="validationServerCpfCnpjFeedback"
                                        class="invalid-feedback text-start">
                                        {{ errors.cnpj_cpf[0] }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-lg-4 mb-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control" :class="errors.email ? 'is-invalid' : ''"
                                        id="validationServerEmail" aria-describedby="validationServerEmailFeedback"
                                        placeholder="Email" v-model="cliente.email">
                                    <label for="validationServerEmail">Email</label>
                                    <div v-if="errors.email" id="validationServerEmailfeedback"
                                        class="invalid-feedback text-start">
                                        {{ errors.email[0] }}</div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-4 mb-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control" :class="errors.tel_cel ? 'is-invalid' : ''"
                                        id="validationServerTelCel" aria-describedby="validationServerTelCelFeedback"
                                        placeholder="Tel. / Cel." v-model="cliente.tel_cel">
                                    <label for="validationServerTelCel">Tel. / Cel.</label>
                                    <div v-if="errors.tel_cel" id="validationServerTelCelfeedback"
                                        class="invalid-feedback text-start">
                                        {{ errors.tel_cel[0] }}</div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-4 mb-2">
                                <div class="form-floating">
                                    <div class="form-check text-start">
                                        <input class="form-check-input" type="checkbox" false-value="0" true-value="1"
                                            id="flexCheckDefault" v-model="cliente.whatsapp">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            whatsapp
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="button" class="btn btn-cancel me-2"
                            @click="(cliente.id ? (this.template = 'visualizar', this.loadCliente(cliente.id)) : (this.template = 'listar', this.cliente = {}), this.loadClientes())">Cancelar</button>
                        <button class="btn btn-acao" type="button"
                            @click="saveCliente(cliente.id ? cliente.id : null)">Salvar</button>
                    </div>
                </div>
                <div>
                    <span class="obgField">* Campo obrigatório.</span>
                </div>
            </template>

            <template v-if="template === 'visualizar'">
                <div class="d-flex justify-content-between areaHeader">
                    <div class="text-start">
                        <span>CLIENTE</span>
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-headArea me-2" title="Lista de clientes"
                            @click="(this.template = 'listar', this.loadClientes())"><i
                                class="fa-solid fa-users"></i></button>
                    </div>
                </div>
                <div class="">
                    <div class="subArea">
                        <div class="title-sub-area">
                            <span>Dados pessoais</span>
                            <div class="d-flex justify-content-end m-2">
                                <button class="btn btn-sm btn-headSubArea"
                                    @click="(this.template = 'salvar', this.loadCliente(cliente.id))" title="Editar"><i
                                        class="fa-solid fa-user-pen"></i></button>
                                <button class="btn btn-sm btn-delete"
                                    @click="(this.template = 'excluir-cliente', this.loadCliente(cliente.id))"
                                    title="Excluir"><i class="fa-regular fa-trash-can"></i></button>
                            </div>
                        </div>

                        <div class="tupla">
                            <div class="field">
                                Nome
                            </div>
                            <div class="data">
                                {{ this.cliente.nome }}
                            </div>
                        </div>
                        <div class="tupla">
                            <div class="field">
                                CPF/CNPJ
                            </div>
                            <div class="data">
                                {{ this.cliente.cnpj_cpf }}
                            </div>
                        </div>
                        <div class="tupla">
                            <div class="field">
                                Email
                            </div>
                            <div class="data">
                                {{ this.cliente.email ? this.cliente.email : '' }}
                            </div>
                        </div>
                        <div class="tupla">
                            <div class="field">
                                Tel./Cel
                            </div>
                            <div class="data">
                                {{ this.cliente.tel_cel ? this.cliente.tel_cel : '' }}{{
                this.cliente.whatsapp ? ' (whatsapp)' : '' }}
                            </div>
                        </div>
                        <div class="tupla">
                            <div class="field">
                                Criado em
                            </div>
                            <div class="data">
                                {{ this.cliente.created_at ?
                formatDate(this.cliente.created_at) :
                '' }}
                            </div>
                        </div>
                        <div class="tupla">
                            <div class="field">
                                Atualizado em
                            </div>
                            <div class="data">
                                {{ this.cliente.updated_at ?
                formatDate(this.cliente.updated_at) :
                '' }}
                            </div>
                        </div>
                    </div>

                    <div class="subArea">
                        <div class="title-sub-area">
                            <span>Endereços</span>
                            <button class="btn btn-sm btn-headSubArea"
                                @click="(this.template = 'salvar-endereco', this.loadCliente(cliente.id))"
                                title="Incluir"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <div v-if="(enderecos.length > 0)">
                            <div v-for="(endereco, index) in enderecos" :key="index"
                                class="border border-primary-subtle mb-3">
                                <div class="tupla">
                                    <div class="field">
                                        Logradouro
                                    </div>
                                    <div class="data">
                                        {{ endereco.logradouro ? endereco.logradouro : '' }}
                                    </div>
                                </div>
                                <div class="tupla">
                                    <div class="field">
                                        Complemento
                                    </div>
                                    <div class="data">
                                        {{ endereco.complemento ? endereco.complemento : '' }}
                                    </div>
                                </div>
                                <div class="tupla">
                                    <div class="field">
                                        Bairro
                                    </div>
                                    <div class="data">
                                        {{ endereco.bairro ? endereco.bairro : '' }}
                                    </div>
                                </div>
                                <div class="tupla">
                                    <div class="field">
                                        Cidade
                                    </div>
                                    <div class="data">
                                        {{ endereco.cidade ? endereco.cidade : '' }}
                                    </div>
                                </div>
                                <div class="tupla">
                                    <div class="field">
                                        CEP
                                    </div>
                                    <div class="data">
                                        {{ endereco.cep ? endereco.cep : '' }}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end m-2">
                                    <button class="btn btn-sm btn-headSubArea"
                                        @click="(this.template = 'salvar-endereco', this.loadEndereco(endereco.id))"
                                        title="Editar"><i class="fa-regular fa-pen-to-square"></i></button>
                                    <button class="btn btn-sm btn btn-delete"
                                        @click="(this.template = 'excluir-endereco', this.loadEndereco(endereco.id))"
                                        title="Excluir"><i class="fa-regular fa-trash-can"></i></button>
                                </div>
                            </div>

                        </div>
                        <div v-else>
                            <span class="lenght0">Nenhum registro localizado.</span>
                        </div>
                    </div>
                </div>
            </template>

            <template v-if="template === 'excluir-cliente'">
                <div class="d-flex justify-content-between areaHeader">
                    <div class="text-start">
                        <span>CLIENTE</span>
                    </div>
                </div>
                <div class="box show">
                    <div class="fs-4 pb-2 mb-4 border-bottom border-dark">
                        <span>Atenção</span>
                    </div>
                    <div style="margin: 10px;">
                        Confirma a exclusão do(a) cliente "{{ this.cliente.nome }}" ?
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-cancel"
                            @click="(this.template = 'visualizar', this.loadCliente(this.cliente.id))">Cancelar</button>
                        <button type="button" class="btn btn-delete"
                            @click="destroyCliente(this.cliente.id)">Excluir</button>
                    </div>
                </div>
            </template>

            <template v-if="template === 'salvar-endereco'">
                <div class="d-flex justify-content-between areaHeader">
                    <div class="text-start">
                        <span>CLIENTE</span>
                    </div>
                </div>
                <div class="card form-bg m-3">
                    <h5 class="card-header">{{ `Novo endereço... (${cliente.nome})` }}</h5>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-12 col-lg-8 mb-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control"
                                        :class="errors.logradouro ? 'is-invalid' : ''" id="validationServerLogradouro"
                                        aria-describedby="validationServerLogradouroFeedback" placeholder="Logradouro"
                                        v-model="endereco.logradouro">
                                    <label for="validationServerLogradouro">Logradouro</label>
                                    <div v-if="errors.logradouro" id="validationServerLogradouroFeedback"
                                        class="invalid-feedback text-start">
                                        {{ errors.logradouro[0] }}</div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-4 mb-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control" :class="errors.cep ? 'is-invalid' : ''"
                                        id="validationServerCep" aria-describedby="validationServerCepFeedback"
                                        placeholder="CEP" v-model="endereco.cep">
                                    <label for="validationServerCep">CEP</label>
                                    <div v-if="errors.cep" id="validationServerCepFeedback"
                                        class="invalid-feedback text-start">
                                        {{ errors.cep[0] }}
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-opcoes search-button" data-bs-toggle="modal"
                                            data-bs-target="#cepModal"><i
                                                class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control"
                                        :class="errors.complemento ? 'is-invalid' : ''" id="validationServerComplemento"
                                        aria-describedby="validationServerComplementoFeedback" placeholder="Complemento"
                                        v-model="endereco.complemento">
                                    <label for="validationServerComplemento">Complemento</label>
                                    <div v-if="errors.complemento" id="validationServerComplementoFeedback"
                                        class="invalid-feedback text-start">
                                        {{ errors.complemento[0] }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-lg-6 mb-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control" :class="errors.bairro ? 'is-invalid' : ''"
                                        id="validationServerBairro" aria-describedby="validationServerBairroFeedback"
                                        placeholder="Endereço" v-model="endereco.bairro">
                                    <label for="validationServerBairro">Bairro</label>
                                    <div v-if="errors.bairro" id="validationServerBairroFeedback"
                                        class="invalid-feedback text-start">
                                        {{ errors.bairro[0] }}</div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-6 mb-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control" :class="errors.cidade ? 'is-invalid' : ''"
                                        id="validationServerCidade" aria-describedby="validationServerCidadeFeedback"
                                        placeholder="Endereço" v-model="endereco.cidade">
                                    <label for="validationServerCidade">Cidade</label>
                                    <div v-if="errors.cidade" id="validationServerCidadeFeedback"
                                        class="invalid-feedback text-start">
                                        {{ errors.cidade[0] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="button" class="btn btn-cancel me-2"
                            @click="(this.template = 'visualizar', this.endereco = {}, this.loadCliente(cliente.id))">Cancelar</button>
                        <button class="btn btn-acao" type="button"
                            @click="saveEndereco(endereco.id ? endereco.id : null, cliente.id)">Salvar</button>
                    </div>
                </div>
                <div>
                    <span class="obgField">* Campo obrigatório.</span>
                </div>

                <!-- Modal CEP -->
                <div class="modal fade" id="cepModal" tabindex="-1" aria-labelledby="cepModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="cepModalLabel">Busca CEP</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex">
                                    <input type="text" class="me-2" placeholder="Digite o cep..." v-model="searchCep">
                                    <button type="button" class="btn btn-acao"
                                        @click="buscaCep(this.searchCep)">Pesquisar</button>
                                </div>
                            </div>
                            <div v-if="(Object.keys(this.cep).length > 0)" class="m-3">
                                <div class="tupla">
                                    <div class="field">
                                        CEP
                                    </div>
                                    <div class="data">
                                        {{ cep.zipcode }}
                                    </div>
                                </div>
                                <div class="tupla">
                                    <div class="field">
                                        Endereço
                                    </div>
                                    <div class="data">
                                        {{ cep.street }}
                                    </div>
                                </div>
                                <div class="tupla">
                                    <div class="field">
                                        Complemento
                                    </div>
                                    <div class="data">
                                        {{ cep.complement }}
                                    </div>
                                </div>
                                <div class="tupla">
                                    <div class="field">
                                        Bairro
                                    </div>
                                    <div class="data">
                                        {{ cep.district }}
                                    </div>
                                </div>
                                <div class="tupla">
                                    <div class="field">
                                        Cidade - UF
                                    </div>
                                    <div class="data">
                                        {{ cep.city }} - {{ cep.stateShortname }}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"
                                    @click="this.resetCep()">Cancelar</button>
                                <button type="button" class="btn btn-acao" data-bs-dismiss="modal"
                                    @click="(this.setEndereco(), this.resetCep())">Aplicar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <template v-if="template === 'excluir-endereco'">
                <div class="d-flex justify-content-between areaHeader">
                    <div class="text-start">
                        <span>CLIENTE</span>
                    </div>
                </div>
                <div class="box show">
                    <div class="fs-4 pb-2 mb-4 border-bottom border-dark">
                        <span>Atenção</span>
                    </div>
                    <div style="margin: 10px;">
                        Confirma a exclusão do(a) endereço <i>"{{ this.endereco.logradouro }}"</i> ?
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-cancel me-2"
                            @click="(this.template = 'visualizar', this.loadCliente(this.endereco.cliente_id))">Cancelar</button>
                        <button type="button" class="btn btn-delete"
                            @click="destroyEndereco(this.endereco)">Excluir</button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
import { mapMutations } from "vuex"
import http from '@/services/http.js'
import AbstractMixin from '@/mixins/AbstractMixin'


export default {

    name: 'ClienteView',

    mixins: [AbstractMixin],

    data() {
        return {
            template: 'listar',
            cliente: {},
            cliente_id: null,
            clientes: {},
            endereco: {},
            enderecos: {},
            searchCep: '',
            cep: {},
            search: '',
            errors: []
        };
    },

    mounted() {
        this.loadClientes()
    },

    methods: {

        ...mapMutations([
            'SET_CLIENTES',
            'SET_CLIENTE',
            'SET_LOADER',
            'PUSH_NOTIFICATION',
        ]),

        async saveCliente(id) {

            this.SET_LOADER({ 'active': true, 'text': 'Salvando dados...' })

            try {
                let metodo = id ? 'patch' : 'post'
                let urlSelected = id ? `${process.env.VUE_APP_BACKEND_URL}/cliente/${id}` : `${process.env.VUE_APP_BACKEND_URL}/cliente`

                let response = await http({ method: metodo, url: urlSelected, data: this.cliente })

                if (response.status == 200 || response.status == 201) {
                    this.PUSH_NOTIFICATION({
                        type: 'sucesso',
                        message: response.data.msg
                    })
                }
                this.errors = []
                this.loadClientes(),
                this.template = 'listar',
                this.cliente = {}
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

        loadClientes() {

            let url = process.env.VUE_APP_BACKEND_URL + '/cliente'

            if (this.search) {
                url = url + '?filtro=nome:like:%' + this.search + '%'
            }

            this.getDadosApi(url)
                .then((result) => {
                    this.clientes = result.data
                })
        },

        loadCliente(id) {

            let url = `${process.env.VUE_APP_BACKEND_URL}/cliente/${id}`

            this.getDadosApi(url)
                .then((result) => {
                    this.cliente = result.data
                })
        },

        async destroyCliente(id) {

            this.SET_LOADER({ 'active': true, 'text': 'Excluindo dados...' })

            try {
                let url = `${process.env.VUE_APP_BACKEND_URL}/cliente/${id}`
                let response = await http.delete(url)
                if (response.status == '200') {
                    this.PUSH_NOTIFICATION({
                        type: 'sucesso',
                        message: response.data.msg
                    })
                    this.errors = []
                    this.loadClientes(),
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

        async saveEndereco(id, cliente_id) {

            this.SET_LOADER({ 'active': true, 'text': 'Salvando dados...' })

            try {
                let metodo = id ? 'patch' : 'post'
                let urlSelected = id ? `${process.env.VUE_APP_BACKEND_URL}/cliente_endereco/${id}` : `${process.env.VUE_APP_BACKEND_URL}/cliente_endereco`

                this.endereco.cliente_id = cliente_id

                let response = await http({ method: metodo, url: urlSelected, data: this.endereco })

                if (response.status == 200 || response.status == 201) {
                    this.PUSH_NOTIFICATION({
                        type: 'sucesso',
                        message: response.data.msg
                    })
                }
                this.errors = []
                this.loadCliente(cliente_id)
                this.loadEnderecos(cliente_id)
                this.endereco = {}
                this.template = 'visualizar'
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

        loadEnderecos(cliente_id) {

            let url = process.env.VUE_APP_BACKEND_URL + '/cliente_endereco?filtro=cliente_id:=:' + cliente_id

            this.getDadosApi(url)
                .then((result) => {
                    this.enderecos = result.data
                })
        },

        loadEndereco(id) {

            let url = `${process.env.VUE_APP_BACKEND_URL}/cliente_endereco/${id}`

            this.getDadosApi(url)
                .then((result) => {
                    this.endereco = result.data
                })
        },

        async destroyEndereco(endereco) {

            this.SET_LOADER({ 'active': true, 'text': 'Excluindo dados...' })

            try {
                let url = `${process.env.VUE_APP_BACKEND_URL}/cliente_endereco/${endereco.id}`
                let response = await http.delete(url)
                if (response.status == '200') {
                    this.PUSH_NOTIFICATION({
                        type: 'sucesso',
                        message: response.data.msg
                    })
                    this.errors = []
                    this.loadCliente(endereco.cliente_id)
                    this.loadEnderecos(endereco.cliente_id)
                    this.template = 'visualizar'
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

        async buscaCep(cep) {

            this.SET_LOADER({ 'active': true, 'text': 'Consultando CEP...' })

            try {
                let url = `https://api.brasilaberto.com/v1/zipcode/${cep}`
                // let url = `http://viacep.com.br/ws/${cep}/json/`

                let response = await http.get(url)

                if (response.status === 200) {
                    this.PUSH_NOTIFICATION({
                        type: 'sucesso',
                        message: 'CEP localicado com sucesso.'
                    })
                }
                this.cep = response.data.result
            }
            catch (error) {
                if (error?.response?.data.result.code === 404) {
                    this.PUSH_NOTIFICATION({
                        type: 'informe',
                        message: 'O CEP informado não existe.'
                    })
                    this.resetCep()
                }
            }
            finally {
                this.SET_LOADER({ 'active': false, 'text': '' })
            }

        },

        resetCep() {
            this.cep = {},
            this.searchCep = ''
        },

        setEndereco() {
            this.endereco.cep = this.cep.zipcode
            this.endereco.logradouro = this.cep.street
            this.endereco.complemento = this.cep.complement
            this.endereco.bairro = this.cep.district
            this.endereco.cidade = this.cep.city + ' - ' + this.cep.stateShortname
            this.resetCep()
        },
    },
};
</script>

<style scoped>

</style>