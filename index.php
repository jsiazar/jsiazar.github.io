<!DOCTYPE HTML>
<?php 
	require "functions/domain.php";
	require "functions/whois.php";

	if(isset($_POST['domain'])) {

		$domainName = $_POST['domain'];
		
		$a = ARecord($domainName);
		$aaaa = AAAARecord($domainName);
		$mx = MXRecord($domainName);
		$ns = NSRecord($domainName);
		$soa = SOARecord($domainName);
		$txt = TXTRecord($domainName);
		$srv = SRVRecord($domainName);
		$cname = CNAMERecord($domainName);

		
		$domain = trim($domainName);
		if(substr(strtolower($domain), 0, 7) == "http://") $domain = substr($domain, 7);
		if(substr(strtolower($domain), 0, 4) == "www.") $domain = substr($domain, 4);
		if(ValidateIP($domain)) {
			$whoisResult = LookupIP($domain);
		}
		else ("Invalid Input!");
	}
?>
<html>
<?php require "assets/header.php"; ?>

                    <form method="POST">
                        <div class="12u 12u$(xsmall)">
                            <input type="text" name="domain" placeholder="<?php if(isset($domainName)) { echo $domainName;} else { echo 'example.com';} ?>" value="" required/>
                        </div>
                        &nbsp;

                        <div class="12u 12u$(xsmall)">
                            <input id="submit" type="submit" name="submit" value="Submit" class="button special small" />
                        </div>

                    </form>
                <?php 
                    if(isset($domainName)) {
                        echo "
                        <p>Lookup results for : <a href=\"http://".$domainName."\" target=\"_blank\"><strong>".$domainName."</strong></a></p>
                        ";
                    }
                ?>
        </div>
				<!-- Nav -->
				<?php 
					if(isset($domainName)) {
						echo "
							<nav id=\"nav\">
								<ul >
									<li>
										<a href=\"http://mxtoolbox.com/SuperTool.aspx?action=blacklist%3a".$domainName."\" target=\"_blank\">Blacklist Check</a>
									</li>
									<li>
										<a href=\"#a\" class=\"active\">A</a>
									</li>
									<li>
										<a href=\"#mx\" >MX</a>
									</li>
									<li>
										<a href=\"#ns\" >NS</a>
									</li>
									<li>
										<a href=\"#soa\" >SOA</a>
									</li>
									<li>
										<a href=\"#txt\" >TXT</a>
									</li>
									<li>
										<a href=\"#srv\" >SRV</a>
									</li>
									<li>
										<a href=\"#cname\" >CNAME</a>
									</li>
								</ul>
							</nav>
						";
					}
				?>	

				<!-- Main -->
					<div id="main">
					<?php 
						if(isset($domainName)) {
							echo "
								
								<section id=\"a\" class=\"main\">
									<div class=\"spotlight\">
										<div class=\"content\">
											<header class=\"major\">
												<h2>IPv4 and IPv6 Records</h2>
											</header>
											<h3><strong>A</strong></h3>
											<p>".$a."</p>
											<h3><strong>AAAA</strong></h3>
											<p>".$aaaa."</p>
										</div>
									</div>
								</section>
								
								<section id=\"mx\" class=\"main\">
									<div class=\"spotlight\">
										<div class=\"content\">
											<header class=\"major\">
												<h2>MX Records</h2>
											</header>
											<p>".$mx."</p>
										</div>
									</div>
								</section>
								
								<section id=\"ns\" class=\"main\">
									<div class=\"spotlight\">
										<div class=\"content\">
											<header class=\"major\">
												<h2>NS Records</h2>
											</header>
											<p>".$ns."</p>
										</div>
									</div>
								</section>
								
								<section id=\"soa\" class=\"main\">
									<div class=\"spotlight\">
										<div class=\"content\">
											<header class=\"major\">
												<h2>SOA Records</h2>
											</header>
											<p>".$soa."</p>
										</div>
									</div>
								</section>
								
								<section id=\"txt\" class=\"main\">
									<div class=\"spotlight\">
										<div class=\"content\">
											<header class=\"major\">
												<h2>TXT Records</h2>
											</header>
											<p>".$txt."</p>
										</div>
									</div>
								</section>
								
								<section id=\"srv\" class=\"main\">
									<div class=\"spotlight\">
										<div class=\"content\">
											<header class=\"major\">
												<h2>SRV Records</h2>
											</header>
											<p>".$srv."</p>
										</div>
									</div>
								</section>
								
								<section id=\"cname\" class=\"main\">
									<div class=\"spotlight\">
										<div class=\"content\">
											<header class=\"major\">
												<h2>CNAME Records</h2>
											</header>
											<p>".$cname."</p>
										</div>
									</div>
								</section>
							";
						}
					?>
				</div>
<?php require "assets/footer.php"; ?>