 <script>
 Uri uri = Uri.parse("upi://pay?pa=payee_address&pn=payee_name&tn=transaction_name&am=1&cu=INR&url=url");//url with http or https
Intent intent = new Intent(Intent.ACTION_VIEW, uri);
//Now magic starts here
intent.setClassName("in.org.npci.upiapp","in.org.npci.upiapp.HomeActivity");
startActivityForResult(intent,1);
</script>
