// JavaScript Document
function gerld(time){
	setInterval(function(){
		nums = document.getElementById('nums_1').innerHTML
		if(nums == 2) {
            document.getElementById('garland').className='garland_2';
            document.getElementById('nums_1').innerHTML='3'
        }
		if(nums == 3) {document.getElementById('garland').className='garland_3';document.getElementById('nums_1').innerHTML='4'}
		if(nums == 4) {document.getElementById('garland').className='garland_4';document.getElementById('nums_1').innerHTML='2'}
	}, time);
}
gerld(800);