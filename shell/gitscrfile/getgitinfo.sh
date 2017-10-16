#!/bin/bash
#
########## 定义变量
#当前路径
workpath=/opt/gitscrfile
mkdir -p $workpath/{view,log,data}

#view路径：$workpath/view/${projectname[$j]}
#ci存放路径：$workpath/log/${projectname[$j]}log
#生成最终数据：$workpath/data/alldata.txt

# HTTP协议项目路径git@git.ihangmei.com:iOS_RD/WangFan_iOS.git，需要分成WangFan_iOS 和 iOS_RD

projectname=(wangfanH5-App portal_train portal_bus wangfanAPP wangfanH5-server airMedia wangfan-topic bizdata-dashboard h5-layout driverApp wangFanCMS easto-H5-2.0 EastJourney dmsAPI PRJ lib OnlineServer PRJApp DMS APPApi DMSNew BaseBU BaseLib SimpleJavaHttpServer heartbeatProject WangFanApp package-video trafficConsum trafficUpload airmedia.uc airmedia.sms.server stats user_manage_system user_manage_system app_backend_service_php airmedia.credits.webserver connect geos dmc-SU noc dmc-interSur dmc-shared dmc-base dmc-hblog azure-eventhub dmc-userCenter dmc-statistics dmc-operatorStatistics dmc-monitor dmc-largeScreen dmc-ims dmc-common dmc-BI dmc-app-train dmc-admin dmc-RS dmc-syschrdata dmc-heartbeat dmc dmc-DR dmc-job dmc-api tools opsdoc RJ-compile-tools WangFanSDK DataProject amdevice DataReceive dmstat LogEtl ServiceMonitor cms-manager cms opsdoc ImageLoaderLibrary FoundationLibary drivers ProjectDeviceApp microad beegoAdSys appserver portal_all portal_bus portal_train test jenkins Appiumapp portalH5 Interportaltest webpoint WFUtils WFNetwork HMAdsTargeted WFAuthSDK iOS_Interview WFNetworking WangFan_iOS station-cron driver-manager)

projectpath=(H5-web H5-web H5-web H5-web H5-web H5-web H5-web H5-web wangfan wangfan liuyun dongxingji eastJourney DMS DMS DMS DMS DMS DMS DMS DMS DMS DMS DMA DMA AndroidTeam App-Services-RD App-Services-RD App-Services-RD App-Services-RD App-Services-RD App-Services-RD App-Services-RD App-Services-RD App-Services-RD App-Services-RD App-Services-RD App-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD Device-Services-RD TEST OPS-GRP Device-Ops-RD sdk bigdata bigdata bigdata bigdata bigdata Monitor service-java-demo service-java-demo OPS-GRP ImageFrame Foundation DeviceApp DeviceApp appserver_php appserver_php appserver_php App-Portal_RD App-Portal_RD App-Portal_RD App-Portal_RD QA_RD QA_RD QA_RD QA_RD QA_RD iOS_RD iOS_RD iOS_RD iOS_RD iOS_RD iOS_RD iOS_RD App-Services-RD dongxingji)

# 日期范围 周一到周五
##begin=$(date +%Y-%m-%d -d tomorrow)
begin=$(date --date '5 days ago' |awk '{print $2",",$3,$4}')
end=$(date |awk '{print $2",",$3,$4}')

begin_1=$(date +%Y-%m-%d  --date '5 days ago' )
end_1=$(date +%Y-%m-%d)
echo -e "begin time:$begin\nend time:$end\nbegin_1 time:$begin_1\nend_1 time:$end_1"

function mk_ci_list()
{
	echo "begin to mk_ci_list ${projectname[$j]}"
	echo "--before=\"$end\" --after=\"$begin\"" |xargs git rev-list --all >$workpath/log/${projectname[$j]}log
}
function getgitinfo()
{
	for ci in `cat $workpath/log/${projectname[$j]}log`
	do
		lines=0
		#name=`git show $ci |sed -n '2p' |awk '{print $2}'`
		name=`git show $ci |grep '^Author' |awk '{print $2}'`
		lines=`git show $ci |grep "^\+[^+].*" |wc -l`
		if [ $lines -gt 0 ]
		then

		    #if egrep "$name" $workpath/data/alldata.txt >/dev/null
			if grep -w "$name" $workpath/data/alldata.txt >/dev/null
			then
				#prelines=`egrep "$name" $workpath/data/alldata.txt |awk '{print $4}'`
				#prelines=`grep -w "$name" $workpath/data/alldata.txt|awk '{print $4}'`
				#去除重复行
				prelines=`grep -w "$name" $workpath/data/alldata.txt|sort -k2n|awk '{if ($0!=line) print;line=$0}'|awk '{print $4}'`
				echo " ci=$ci prelines=$prelines lines=$lines"
				lines=$[$lines + $prelines]
				newcontent=`echo -e "$begin_1\t$end_1	$name	$lines"` 
				echo " '/${name}/c $newcontent' $workpath/data/alldata.txt" |xargs sed -i
			else
				echo -e "$begin_1\t$end_1	$name	$lines" >> $workpath/data/alldata.txt				
			fi
		fi		
	done
	#替换@ihangmei.com为空
	sed -i 's/@ihangmei.com//g' $workpath/data/alldata.txt
	#去除重复行
    sort -k4nr $workpath/data/alldata.txt | sed '$!N; /^\(.*\)\n\1$/!P; D' > $workpath/data/data.txt #sort -k4nr 按第4列大小倒序排列
    rm $workpath/data/alldata.txt
	mv $workpath/data/data.txt $workpath/data/alldata.txt
}
function mkdata()
{
	#下载视图、生成log信息
	for i in `seq 1 ${#projectpath[@]}`	#i是1 2...
	do
		j=$[$i - 1]
		# 例如：currentPRO=http://git.ihangmei.com/iOS_RD/WangFan_iOS.git
		# 例如：${projectname[$j]}是WangFan_iOS
		currentPRO=git@git.ihangmei.com:${projectpath[$j]}/${projectname[$j]}.git
		echo "currentPRO= $currentPRO"
		if [ -d $workpath/view/${projectname[$j]} ]
			then
				cd $workpath/view/${projectname[$j]}
				git fetch  &> /dev/null
			else
				cd $workpath/view
				git clone $currentPRO &> /dev/null
				cd $workpath/view/${projectname[$j]}				
		fi
		cd $workpath/view/${projectname[$j]}
		mk_ci_list
		getgitinfo
	done
}

mv $workpath/data/alldata.txt $workpath/data/${begin_1}_${end_1}.txt
touch $workpath/data/alldata.txt
mkdata

