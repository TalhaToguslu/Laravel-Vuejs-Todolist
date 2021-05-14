<template>
  <div>

    <div class="bg-light p-2 my-2 shadow rounded" v-for="(con,index) in contents">
      <div class="d-flex justify-content-between px-2 pt-2 bg-white rounded shadow-sm">
        <h5>{{con.title}}</h5>
        <span>{{con.date}} / {{con.hour}}:0{{con.minute}}</span>
      </div>
      <div class="p-2">
        <p>{{con.content}}</p>
      </div>
      <div class="d-flex justify-content-end">
        <button type="button" data-toggle="tooltip" data-placement="top" v-on:click="completeFunc(con.id)" title="Tamamlandı" class="btn btn-success m-1"><i class="fas fa-check"></i></button>
      </div>
    </div>

  </div>
</template>

<script>
  export default{
    props: ['contents'],
    data(){
      return{
        complete_hover:[],
        cancel_hover:[],
        Toast:null,
      }
    },
    mounted(){

        $('[data-toggle="tooltip"]').tooltip()

        this.Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        });
    },
    methods:{
      completeFunc:function(id){
        axios.post('http://localhost:8000/api/completed',{
          id:id,
        }).then((response)=>{
          this.$emit("complete-content")
          this.Toast.fire({
            icon: 'success',
            title: 'Randevu Tamamlandı.'
          })
        })
      },
    }
  }
</script>
