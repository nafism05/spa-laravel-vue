<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Data Mahasiswa</h3></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <router-link to="/add" tag="button" class="btn btn-sm btn-success">Tambah Data</router-link>
                            </div>
                            <div class="col-sm-3 col-sm-offset-6">
                                <input type="text" class="form-control" v-model="cari" name="cari" v-on:keyup="filterData" placeholder="Cari Berdasarkan Nama">
                            </div>
                            
                        </div>
                        
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th width="10%">NIM</th>
                                    <th>Nama</th>
                                    <th width="10%">Tanggal Lahir</th>
                                    <th width="10%">Jenis Kelamin</th>
                                    <th width="8%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='item in items'>
                                    <td>{{ item.nim }}</td>
                                    <td>{{ item.nama }}</td>
                                    <td>{{ item.tanggal_lahir }}</td>
                                    <td class="text-center">{{ item.jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-xs btn-danger" v-on:click="deleteData(item.id)">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                        <router-link :to="{ name: 'mahasiswaEdit', params: { id: item.id }}" tag="button" class="btn btn-xs btn-info">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </router-link>
                                    </td>
                                </tr>
                            </tbody>
                                
                      </table>
                        <div class="text-left">
                            <p>Halaman {{current_page}} - Menampilkan {{from}} Ke {{to}} of {{total}} Data</p>
                        </div>
                        <div class="text-right">
                            <ul class="pagination">
                                <li><button type="button" class="btn btn-default" v-on:click="prevPage" :disabled="!this.prev"><span class="glyphicon glyphicon-triangle-left"></span></button></li>
                                <li><button type="button" class="btn btn-default" v-on:click="nextPage" :disabled="!this.next"><span class="glyphicon glyphicon-triangle-right"></span></button></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                items : "",
                prev  : "",
                next  : "",
                cari  : "",
                current_page : "",
                to : "",
                total : "",
                from : "",
            }
            
        },
        created() {
            this.getMahasiswa()
        },
        methods: {
            getMahasiswa(){
                var vm = this
                axios.get('/getmahasiswa')
                .then(function(response){
                    vm.items = response.data.mahasiswa.data;
                    vm.prev = response.data.mahasiswa.prev_page_url;
                    vm.next = response.data.mahasiswa.next_page_url;
                    vm.current_page = response.data.mahasiswa.current_page;
                    vm.to = response.data.mahasiswa.to;
                    vm.total = response.data.mahasiswa.total;
                    vm.from = response.data.mahasiswa.from;
                })
                .catch(function(error){
                    console.log(error)
                })
            },


            prevPage(){
                var vm = this
                axios.get(this.prev)
                .then(function(response){
                    vm.items = response.data.mahasiswa.data;
                    vm.prev = response.data.mahasiswa.prev_page_url;
                    vm.next = response.data.mahasiswa.next_page_url;
                    vm.current_page = response.data.mahasiswa.current_page;
                    vm.to = response.data.mahasiswa.to;
                    vm.total = response.data.mahasiswa.total;
                    vm.from = response.data.mahasiswa.from;
                }).catch(function(error){
                    console.log(error);
                })
            },


            nextPage(){
                var vm = this
                axios.get(this.next)
                .then(function(response){
                    vm.items = response.data.mahasiswa.data;
                    vm.prev = response.data.mahasiswa.prev_page_url;
                    vm.next = response.data.mahasiswa.next_page_url;
                    vm.current_page = response.data.mahasiswa.current_page;
                    vm.to = response.data.mahasiswa.to;
                    vm.total = response.data.mahasiswa.total;
                    vm.from = response.data.mahasiswa.from;
                }).catch(function(error){
                    console.log(error);
                })
            },



            filterData(){
                var vm = this
                axios.get('/getmahasiswa'+'?cari='+this.cari)
                .then(function(response){
                    vm.items = response.data.mahasiswa.data;
                    vm.prev = response.data.mahasiswa.prev_page_url;
                    vm.next = response.data.mahasiswa.next_page_url;
                    vm.current_page = response.data.mahasiswa.current_page;
                    vm.to = response.data.mahasiswa.to;
                    vm.total = response.data.mahasiswa.total;
                    vm.from = response.data.mahasiswa.from;
                })
                .catch(function(error){
                    console.log(error);
                })
            },
            deleteData(id){
                var x = confirm("Are you sure you want to delete?");
                if (x) {
                    axios.delete("mahaiswa/"+id)
                    .then(function(response){

                    });
                    this.getMahasiswa();
                } else {
                    alert("Tidak Terhapus");
                }
            },
        }
    }
</script>
