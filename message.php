<?php if(isset($message)){
	echo "
	<script>
	swal({
  	title: '".$title."',
  	text: '".$message."',
 	icon: '".$icon."',
	})
	.then((ok)=>{
  	if(ok) {
    window.location.href='".$page."';
  	}
	});
	</script>
	";
	unset($message);
} ?>