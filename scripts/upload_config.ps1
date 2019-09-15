
$name = Get-CimInstance -ClassName Win32_ComputerSystem | Select-Object -ExpandProperty Name
$domain = Get-CimInstance -ClassName Win32_ComputerSystem | Select-Object -ExpandProperty Domain
$fqdn = $name +'.' +$domain

$cs = Get-WmiObject -class Win32_ComputerSystem
$cpu=$cs.numberoflogicalprocessors

$ram = Get-WmiObject -Class Win32_OperatingSystem -Namespace root/cimv2 -ComputerName . | Select-object -ExpandProperty TotalVisibleMemorySize
$ram = $ram / (1024 * 1024)


$hdd = Get-CimInstance -ClassName Win32_LogicalDisk -Filter "DriveType=3" -ComputerName . | Select-Object -ExpandProperty Size
$hdd = $hdd / (1024 * 1024 * 1022)

$os = (Get-WMIObject win32_operatingsystem).name
$os_hotfix = Get-CimInstance -ClassName Win32_QuickFixEngineering -ComputerName . -Property HotFixId | Select-Object -ExpandProperty HotFixId -first 1

$firewall_check = get-netfirewallprofile -name Domain | select-object -ExpandProperty enabled
$firewall_enabled = 0
if ($firewall_check = "enabled") { $firewall_enabled = 1 }

$lan_check = get-wmiobject win32_networkadapter -filter "netconnectionstatus = 2"
$lan_enabled = 0
 if ($lan_check) { $lan_enabled = 1 }
 
$netmask = Get-WmiObject Win32_NetworkAdapterConfiguration | Where IPEnabled | select-object -expandproperty IPSubnet |select-object -first 1

$dns = Get-WmiObject Win32_NetworkAdapterConfiguration | Where IPEnabled | select-object -expandproperty DNSServerSearchOrder |select-object -first 1

$gateway = Get-WmiObject Win32_NetworkAdapterConfiguration | Where IPEnabled | select-object -expandproperty  DefaultIPGateway |select-object -first 1

$usb = 1
$cd = 0
$keyboard = 1
$mouse = 0
$uri = "http://10.20.228.6:8000/workstation/post-json"
$Body = @{
		hdd = $hdd
		ram = $ram
		fqdn = $fqdn
		cpu = $cpu
		os = $os
		os_version = $os_hotfix
		firewall_enabled = $firewall_enabled
		lan_enabled = $lan_enabled
		lan_mask = $netmask
		lan_dns = $dns
		lan_gateway = $gateway
		devices_usb = $usb
		devices_cd = $cd
		devices_mouse = $mouse
		devices_keyboard = $keyboard
}
Invoke-RestMethod -Uri $uri -Method 'Post' -Body $Body 
