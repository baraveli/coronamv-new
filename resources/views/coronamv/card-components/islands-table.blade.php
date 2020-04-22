<div class="shadow-sm p-2 mt-2 bg-white rounded">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col" class="divtype f6">ފަރުވާ ދެމުންގެންދާ ޢަދަދު</th>
          <th scope="col" class="divtype f6">ރަނގަޅުވެފައިވާ ޢަދަދު</th>
          <th scope="col" class="divtype f6">ބަލިޖެހިފައިވާ ޢަދަދު</th>
          <th scope="col" class="divtype f6"> ނަން</th>
        </tr>
      </thead>
      <tbody>
        <template>
          <tr class="divtype-normal o-90" v-for="mvcase in maldives.cases">
            <td> @{{mvcase.active}}</td>
            <td> @{{mvcase.recovered}}</td>
            <td> @{{mvcase.confirmed}}</td>
            <td> @{{mvcase.div_name}}</td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>

