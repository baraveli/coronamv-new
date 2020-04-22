<div class="shadow-sm p-3 mt-2 mb-5 bg-white rounded">
    <div class="flex flex-wrap mt3 nl3 nr3">
      <status-card class="card-settings" text="ރަނގަޅު ވެފައިވާ އަދަދު" colour="t-green"
        :value="infectionData.total_recovered"></status-card>
      <status-card class="card-settings" text="ބަލިޖެހިފައިވާ ޢަދަދު" colour="t-orange"
        :value="infectionData.total_cases"></status-card>
      <status-card class="card-settings" text="މަރުގެ އަދަދު" colour="t-red" :value="infectionData.total_death">
      </status-card>

      <status-card class="card-settings" text="ފަރުވާ ދެމުންގެންދާ ޢަދަދު" colour="t-yellow"
        :value="infectionData.active_cases">
      </status-card>

    </div>

  </div>