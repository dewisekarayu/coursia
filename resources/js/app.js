document.addEventListener('DOMContentLoaded', function(){
  const tableSearch = document.getElementById('tableSearch');
  if(tableSearch){
    tableSearch.addEventListener('input', function(){
      const q = this.value.toLowerCase();
      document.querySelectorAll('#studentsTable tbody tr').forEach(row=>{
        const txt = row.innerText.toLowerCase();
        row.style.display = txt.indexOf(q) > -1 ? '' : 'none';
      });
    });
  }
});