<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/menu.php'); ?>

<div class="quiz-result">
    <div class="result-won result-bolock">
        <div class="name"><span id="Won"></span> Won</div>
        <div class="percent">(<span id="winnerScore"></span>)</div>
    </div>
    <div class="vs">Vs</div>
    <div class="result-lost result-bolock">
        <div class="name"><span id="Lost"></span> Lost</div>
        <div class="percent">(<span id="LooserScore"></span>)</div>
    </div>
</div>

<script type="text/javascript" src="services.js"></script>
<script>
    public RematchInterval;
  public ShouldCheckAgain = true;
  public intervalCounter = 0;
  public loader;

  public res = {winnerid: '', 
    oppid: '', oppname: '', oppPercentage: 0, MyPercentage: 0,
    Questions: []};
  public OppScore = 0;
  public MyScore = 0;
  public winnerScore = "0";
  public LooserScore = "0";
  public Lost = "";
  public Won = "";
  public AgainstId = '0';
  public ScoreTieMsg="";
  public ShowTrophy = false;
  public DisplayTestId = "";

   /*constructor(public navCtrl: NavController, public dbService: ServerService,
      public groupService: GroupQuizService, public shareService: ShareValuesService) {
   }*/
   $(document).ready(function(){
       ngOnInit();
             console.log("Ai winner");
   });
    function ngOnInit() {
             console.log("Ai winner2");
      this.GetPropertyAsPromise("AgainstId").then(_aId => {
             console.log("Ai winner3");
         if (_aId == '1') {
            this.AIWinner();
         } else if (_aId == '4') {
            //this.GroupWinner();
         } else {
            //this.TwoPlayerWinner();
         }
      });
   }
    AIWinner() {
    this.GetPropertyAsPromise("OppResult").then(_OppScore => {
      this.OppScore = +_OppScore;
      this.GetPropertyAsPromise("MyResult").then(_myScore => {
        this.MyScore = +_myScore;
        setTimeout(() => {
          if(this.OppScore > this.MyScore) {
            console.log("You lost");
            this.winnerScore = this.OppScore+"%";
            this.LooserScore = this.MyScore+"%";
            this.Won = "AI";
            this.Lost = "You";
          } else if(this.OppScore < this.MyScore) {
            console.log("You Won");
            this.winnerScore = this.MyScore+"%";
            this.LooserScore = this.OppScore+"%";
            this.Won = "You";
            this.Lost = "AI";
          } else {
            this.dbServer.GetPropertyAsPromise("MyCorrectTime").then(_myTime => {
              this.dbServer.GetPropertyAsPromise("OppCorrectTime").then(_OppTime => {
                if(_OppTime == "max"){
                  this.winnerScore = this.MyScore+"%";
                  this.LooserScore = this.OppScore+"%";
                  this.Won = "You";
                  this.Lost = "AI";
                } else if(+_OppTime < +_myTime){
                  this.winnerScore = this.OppScore+"%";
                  this.LooserScore = this.MyScore+"%";
                  this.Won = "AI";
                  this.Lost = "You";
                } else {
                  this.winnerScore = this.MyScore+"%";
                  this.LooserScore = this.OppScore+"%";
                  this.Won = "You";
                  this.Lost = "AI";
                }
                if((this.OppScore == this.MyScore) && this.Won == 'You') {
                  this.ScoreTieMsg = this.Won+" are faster than "+this.Lost;
                } else if ((this.OppScore == this.MyScore) && this.Lost == 'You') {
                  this.ScoreTieMsg = this.Won+" is faster than "+this.Lost;
                }
              });
            });
          }
          //this.ShowScore();
          setTimeout(() => {
              $("#Won").html(this.Won);
              $("#Lost").html(this.Lost);
          });
        }, 400);
      });
    });
  }
    function goToRoot() {
      //this.navCtrl.navigateRoot('home');
   }
</script>


<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/footer.php'); ?>