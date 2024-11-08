<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/menu.php'); ?>


<?php //include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/header.php');
//include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/menu.php'); 
?>
 

<style>
    .module{
        background: 
        linear-gradient(
        rgba(0, 0, 0, 0.6),
        rgba(0, 0, 0, 0.6)
        ),
        url(http://sarmicrosystems.in/quiztest/web/asset/woman_sitting.jpg);
        background-size: cover;
        width: 100%;
        height: 700px;
        /*margin: 10px 0 0 10px;*/
        position: relative;
        float: left;
    }
.heading h2 {
  font-family: 'Roboto', sans-serif;
  font-weight: 900;
  color: white;
  text-transform: uppercase;
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 2rem;
  transform: translate(-50%, -50%);
}
    
</style>   

<div class="banner">
    
    <div class="module">
        
    
    
    <h2 class="heading">Play With Your Gang ! </h2>
    </div>
</div>

<div class="groups-container">
    <ul>
        <li>Group 1</li>
        <li>Group 2</li>
    </ul>
    
</div>
<script type="text/javascript" src="services.js"></script>
<script>
    var touchcounter = 0;
    var touchTimer;
    var PreviousOpenId = 0;
    var Groups =[];
    var SelfUserId = 0;
    $(document).ready(function(){
       LoadAllGroups();
    });
    function LoadAllGroups() {
        this.Groups = [];
        this.GetPropertyAsPromise("userid").then(_uId => {
          this.SelfUserId = _uId;
          this.GetAllGroups().then((data) => {
            if(data && data !== null && typeof data !== undefined) {
              for(let i=0;i<data.length; i++){
                let g = data[i]["data"];
                this.Groups[i] = {};
                this.Groups[i].Id = g["group_id"];
                this.Groups[i].GroupName = g["group_name"];
                this.Groups[i].AdminId = g["admin_id"];
                this.Groups[i].AdminStatus = g["status"]=="1"?true:false;
                if(g["admin_id"] === _uId) {
                  this.Groups[i].AmIAdmin = true;
                } else {
                  this.Groups[i].AmIAdmin = false;
                }
                this.Groups[i].AdminName = g["admin_name"];
                let _m = g["group_members_name"];
                console.log(_m);
                this.Groups[i].Members = [];
                let index = 0;
                if(g["group_members_name"] !== null && typeof g["group_members_name"] !== undefined) {
                  for(let j =0; j< g["group_members_name"].length; j++) {
                    let m = g["group_members_name"][j];
                    if(m["id"] !== _uId){
                      this.Groups[i].Members[index] = {};
                      this.Groups[i].Members[index].Id = m["id"];
                      this.Groups[i].Members[index].Name = m["name"];
                      this.Groups[i].Members[index].Status = m["status"]=="1"?true:false;
                      index++;
                    }
                  }
                }
                DisplayGroups();
              }
              setTimeout(() => {
                console.log(this.Groups);
              }, 1000);
            }
          });
        });
  }
    function GetAllGroups() {
        return new Promise((resolve, reject)=> {
            this.GetPropertyAsPromise("userid").then(_uId => {
                let fd = new FormData();
                fd.append("userid", _uId);
                this.PostData(this.CommUrl + "api/group/group_info.php", fd).then(
                    data=> {
                        console.log("Groups: ", data);
                        resolve(data);
                    }
                );
            }).catch(() => {reject();});
        });
    }
    function DisplayGroups() {
        if(Groups.length > 0) {
            var htm = "";
            for(let g of Groups) {
                htm += `<li onclick="PlayWith(`+g.Id+`)">
                        `+g.GroupName+`
                    </li>`;
            }
            $(".groups-container ul").html(htm);
        }
    }
    function PlayWith(GroupId){
        
    }
</script>

<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/footer.php'); ?>