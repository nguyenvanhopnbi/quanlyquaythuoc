Livewire.on('searchDashboardScript', ()=>{
    var startTime = document.getElementById('startTimeSearch').value;
    var endTime = document.getElementById('endTimeSearch').value;

    Livewire.emit('searchDashboard', startTime, endTime);
});










