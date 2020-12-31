<?php
/**
 * 同仁医院HIS中转接口()
 * Class Hos110101001002Controller
 */
namespace Api\Controller;

use Api\Controller\CommonController;
use Common\Controller\ApiErrDescController;
use Common\Common\ApiNameEnum;
use think\Log;
// require_once 'UnionClient.php';
class Hos110101001002Controller extends BaseController
{
    // 不在自助机上缴费的费别集合
    protected static $feeTypeArr = array(
        '医保特药',
        '北京医保特病',
        // '自费',
        // '北京医保在职',
        // '北京医保退休',
        // '北京医保学生儿童',
        // '北京医保无保障老年人',
        // '北京医保无业居民',
        // '北京医保超转人员',
        // '北京离休统筹',
        // '北京公疗医照',
        // '北京工伤保险',
        // '北京生育保险',
        // '公费医疗',
        // '北京新农合',
        // '外埠新农合',
        // '外埠医保',
        // '其他',
        // '北京医保',
        // '商业保险',
        // '特批',
        // '外埠城镇职工医保',
        // '外埠城镇居民医保',
        // '异地医保实时结算-职工',
        // '跨省就医新农合患者',
        // '异地医保实时结算-居民',
        // '医保未交卡',
        // '商保记账',
        // '军休医照人员',
        // '军休离休人员',
        // '军休医保公费',
        // '军休军残公费医疗人员',
        // '核酸检测(第三方订单用)',
    );
    // protected static $SERVER_ADDR = 'http://192.168.98.56/dthealth/web/DHCBILL.SelfPay.SOAP.SelfPaySoap.CLS?WSDL=1';//缴费 查询
    // protected static $SERVER_ADDR = 'http://192.168.98.56:57772/dthealth/web/DHCExternalService.RegInterface.Service.SelfRegService.cls?WSDL=1';//挂号/预约/取号
    // protected static  $SERVER_ADDR = 'http://192.168.98.56:57772/dthealth/web/DHCExternalService.OPAlloc.Service.OPAllocService.cls?WSDL=1';// 报到
    protected static $SERVER_ADDR ='http://10.1.6.36/csp/i-pay/DHC.PAY.BS.ZZJService.cls?WSDL=1';//平台  10.1.6.36 测试 192.168.98.40
    protected static $DZBLSERVER_ADDR ='http://10.1.6.26:54552/JHOODService.asmx?wsdl';//电子病历
    protected static $LOGS_PATH = './Application/Runtime/Logs/log.txt';
    protected static $REFUND_ADDR = 'http://192.168.98.64:8080/1231/soap/Service.php?wsdl';//我方退款Web
    public function test()
    {

       /*  $str = '{"errCode":"00","errInfo":"10000\u6210\u529f\u54cd\u5e94\u7801","transactionTime":"181547","transactionDate":"1030","settlementDate":"1030","transactionDateWithYear":"20201030","settlementDateWithYear":"20201030","retrievalRefNum":"16075365974W","transactionAmount":"5000","actualTransactionAmount":"5000","amount":"5000","orderId":"20201030181546016075365974","thirdPartyDiscountInstrution":"\u652f\u4ed8\u5b9d\u94b1\u5305\u652f\u4ed850.0\u5143","thirdPartyDiscountInstruction":"\u652f\u4ed8\u5b9d\u94b1\u5305\u652f\u4ed850.0\u5143","thirdPartyName":"\u652f\u4ed8\u5b9d\u94b1\u5305","userId":"2088022935615511","thirdPartyBuyerId":"2088022935615511","thirdPartyBuyerUserName":"176******39","thirdPartyOrderId":"2020103022001415515742782533","thirdPartyPayInformation":"\u652f\u4ed8\u5b9d\u4f59\u989d:5000","cardAttr":"91","mchntName":"\u9996\u90fd\u533b\u79d1\u5927\u5b66\u9644\u5c5e\u5317\u4eac\u540c\u4ec1\u533b\u9662"}';
        $str = json_decode($str,true);
        print_r($str);exit;
        $date = date("Y-m-d",time());
        $time = date('H:i:s',time()); */
       /*  $str = '<Request>
                <TradeCode>1004</TradeCode>
                <ExtOrgCode></ExtOrgCode>
                <ClientType></ClientType>
                <HospitalId>2</HospitalId>
                <ExtUserID>rwnqzzj01</ExtUserID>
                <StartDate>'.$date.'</StartDate>
                <EndDate>'.$date.'</EndDate>
                <DepartmentCode>748</DepartmentCode>
                <ServiceCode></ServiceCode>
                <DoctorCode></DoctorCode>
                <RBASSessionCode></RBASSessionCode>
                <StopScheduleFlag></StopScheduleFlag>
                <PatientID></PatientID>
                <SessType></SessType>
        </Request>'; 
         $result = $this->reqSoap($str,'QueryAdmSchedule');
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        */
        // 8399||2737
        /*   $str  = '<Request>
                    <TradeCode>10015</TradeCode>
                    <ClientType></ClientType>
                    <HospitalID>2</HospitalID>
                    <TradeDate>'.$date.'</TradeDate>
                    <TradeTime>'.$time.'</TradeTime>
                    <ExtUserID>rwnqzzj01</ExtUserID>
                    <ScheduleItemCode>8399||2737</ScheduleItemCode>
                    <AdmDoc></AdmDoc>
                    <PatientID>0005555020</PatientID>
                    <CardNo>98000004699648</CardNo>
                    <CardType>4</CardType>
                    <CredTypeCode></CredTypeCode>
                    <IDCardNo></IDCardNo>
                    <TransactionId></TransactionId>
                    <OldTransactionId></OldTransactionId>
                    <Mobile></Mobile>
                    <LockQueueNo></LockQueueNo>
                    <PayOrdId></PayOrdId>
            </Request>';
            $result = $this->reqSoap($str,'LockOrder');
            $result = strstr($result, "<Response>");
            $OB_OutXml = simplexml_load_string($result);
            $rel = json_decode(json_encode($OB_OutXml),true); */
  /*           //Array
(
[TradeCode] => 10015
[TransactionId] => 6302696
[ResultCode] => 0
[ResultContent] => 加号成功
[LockQueueNo] => 1
[ScheduleItemCode] => 8399||2737
[AdmDoc] => 开卡(免费号)
[AdmDate] => 2020-11-01
[RegFee] => 0
) */    /* $id = '';
        $str = ' <Request>
                <TradeCode>1101</TradeCode>
                <TransactionId>'.$id.'</TransactionId>
                <ExtOrgCode></ExtOrgCode>
                <ClientType></ClientType>
                <HospitalId>2</HospitalId>
                <TerminalID></TerminalID>
                <ScheduleItemCode>8399||2737</ScheduleItemCode>
                <AppOrderCode></AppOrderCode>
                <ExtUserID>rwnqzzj01</ExtUserID>
                <PatientCard>98000004699648</PatientCard>
                <CardType>4</CardType>
                <PatientID>0005555020</PatientID>
                <PayBankCode></PayBankCode>
                <PayCardNo></PayCardNo>
                <PayModeCode>QT</PayModeCode>
                <PayFee>0.00</PayFee>
                <PayInsuFeeStr></PayInsuFeeStr>
                <PayTradeNo>H290no20201031204642133254</PayTradeNo>
                <QueueNo>1</QueueNo>
                <PayDetails>
                    <PayModeCode>QT</PayModeCode>
                    <TradeChannel>RWZB</TradeChannel>
                    <PayAccountNo></PayAccountNo>
                    <PayAmt>0.00</PayAmt>
                    <PlatformNo>H290no20201031204642133254</PlatformNo>
                    <OutPayNo></OutPayNo>
                    <PayChannel></PayChannel>
                    <POSPayStr></POSPayStr>
                    <PayDate>'.$date.'</PayDate>
                    <PayTime>'.$time.'</PayTime>
                </PayDetails>
        </Request>';
        $result = $this->reqSoap($str,'OPRegister');
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true); */
        //获取就诊记录
       /*  $str = '<Request>
                <TradeCode>4902</TradeCode>
                <HospitalID></HospitalID>
                <CardNo>98000004699648</CardNo>
                <CardType>2</CardType>
                <SecrityNo>0</SecrityNo>
                <PatientID>0005555020</PatientID>
                <UserCode>rwnqzzj01</UserCode>
                <TerminalID>rwnqzzj01</TerminalID>
                <StartDate>'.$date.'</StartDate>
                <EndDate>'.$date.'</EndDate>
                <ExpStr></ExpStr>
        </Request>'; */
        //获取明细
       /*  $str = '<Request>
                <TradeCode>4904</TradeCode>
                <HospitalID></HospitalID>
                <CardNo>98000004699648</CardNo>
                <CardType>4</CardType>
                <SecrityNo>0</SecrityNo>
                <PatientID>0005555020</PatientID>
                <UserCode>rwnqzzj01</UserCode>
                <TerminalID>rwnqzzj01</TerminalID>
                <StartDate>'.$date.'</StartDate>
                <EndDate>'.$date.'</EndDate>
                <ExpStr></ExpStr>
                <Adm>14982280</Adm>
            </Request>'; */
        //划价
       /*  $diagnoseNo = '14982280';
        $recipeNo = '20201101113500BJTR8956';
        $chargeTotal = '120'; */
        // $str = '<Request>
        //             <TradeCode>9999</TradeCode>
        //             <StDTime>2020-11-05 00:00:00</StDTime>
        //             <EndDTime>2020-11-05 23:59:59</EndDTime>
        //             <BalFlag>2</BalFlag>
        //             <BalChannel>MISSCAN</BalChannel>
        //         </Request>';
        // //BalChannel  MISSCAN 扫码  MISPOS 银行卡     BalFlag  1收费   2 退费 
        // $result = $this->reqSoap($str,'ZZJCommonPay');


        $str = '<Request>
                <TradeCode>3300</TradeCode>
                <TransactionId></TransactionId>
                <ExtOrgCode></ExtOrgCode>
                <ClientType></ClientType>
                <TerminalID></TerminalID>
                <HospitalId>2</HospitalId>
                <ExtUserID>rwnqzzj01</ExtUserID>
                <PatientCard></PatientCard>
                <CardType></CardType>
                <PatientID></PatientID>
                <Phone></Phone>
                <IDCardType>01</IDCardType>
                <IDNo>230811198306032446</IDNo>
                <PatientName>孙佳楠</PatientName>
        </Request>';
        $result = $this->reqSoap($str,'GetPatInfo');
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        var_dump($result);
      
    }
    /**
     * 2020年10月27日09:51:31
     * HIS调用的预约挂号退号接口
     * 邵冠亚
     * 
     */
    public function taketicket()
    {
        header('Content-Type: application/xml;charset=utf8');
        $fileName = "Application/Runtime/Logs/HISRefund/his_".date('Ymd') . '.log';
        // 接收HIS传来的参数
        $postdata = file_get_contents("php://input");
        $data = urldecode($postdata);
        $log = '';
        $log .= 'TIME:' . date('Y-m-d H:i:s') . "\n";
        $log .= 'apiName: taketicket'."\n";
        $log .= 'IN:请求:'.$postdata."\n";
        $log .= "\t\n";
        $rs = file_put_contents($fileName, $log, FILE_APPEND);
        $OB_OutXml = simplexml_load_string($data);
        $requestData = json_decode(json_encode($OB_OutXml),true);
        $treatCardNo = $requestData['input']['card_no'];//I('post.card_no');//患者卡号
        $refundAmount = $requestData['input']['medicare_amount'];// I('post.refund_amount');//退款金额 医保报销金额
        $totalAmount = $requestData['input']['total_amount'];//I('post.total_amount');//总金额
        $personPay = $requestData['input']['medicare_personal_fee'];// 自付金额
        $visitTime = $requestData['input']['visit_time'];//I('post.visit_time');//就诊时间
        $tradeNo = $requestData['input']['yuntai_pay_no'];// I('post.yuntai_pay_no');//流水号 
        $outTradeNo = $requestData['input']['reg_no'];//I('post.reg_no');//订单号
        //先判断  医保报销金额 为空 和 自付金额 为 0 的情况 直接给HIS返回成功
        if(empty($refundAmount) && (int)$personPay == 0)
        {
            $result = '<?xml version="1.0" encoding="utf-8"?>
                        <response>
                            <ret_code>0</ret_code>
                            <ret_msg></ret_msg>
                            <output>
                                <refund_no></refund_no>
                                <amount></amount>
                                <refund_time></refund_time>
                                <card_no>'.$treatCardNo.'</card_no>
                            </output>
                        </response>';
             //记录日志
            $log = '';
            $log .= 'TIME:' . date('Y-m-d H:i:s') . "\n";
            $log .= 'apiName: taketicket'."\n";
            $log .= 'OUT:响应时间:'. $result . "\n";
            $log .= "\t\n";
            $rs = file_put_contents($fileName, $log, FILE_APPEND);
            //记录日志
            echo  $result;die();
        }
        //判断HIS传的必传参数是否准确
        if(empty($treatCardNo) || $treatCardNo == null )
        {
            $msg = '卡号不能为空';
        }else if(empty($refundAmount) || $refundAmount == null )
        {
            $msg = '退款金额不能为空';
        }else if(empty($totalAmount) || $totalAmount == null )
        {
            $msg = '订单总金额不能为空';
        }else if(empty($outTradeNo) || $outTradeNo == null )
        {
            $msg = '订单号不能为空';
        }else
        {
            $msg = '';
        }
        //实例化本地支付Soap
        $soap = new \SoapClient(self::$REFUND_ADDR);
        if(substr($outTradeNo,0,1) == 'w')
        {
            //微信退款
            $requestTime = date("H:i:s:u");
            $result=$soap->WxRefused($outTradeNo,$totalAmount,$refundAmount,"HIS");
            $responsetTime = date("H:i:s:u");
        }else
        {
            //支付宝退款
            $requestTime = date("H:i:s:u");
            $result=$soap->refund($outTradeNo,$refundAmount,"HIS");
            $responsetTime = date("H:i:s:u");
        }
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        if(substr($outTradeNo,0,1) == 'w'){
            //微信
            $refund_no = $rel['Message']['RealData']['retrievalRefNum'];//退款单号
            $amount=$rel['Message']['refund_fee'];//退款金额
            
        }else{
            //支付宝
            $refund_no = $rel['Message']['RealData']['retrievalRefNum'];//退款单号
            $amount=$rel['Message']['Refund_fee'];//退款金额
        }
        $refund_time = date("YmdHis",time());//退款时间
        $card_no = $treatCardNo;//卡号
        if ($rel['Message']['RealData']['errCode'] == '00' && $msg == '') 
        {
            $ret_code = '0';
            $ret_msg  = '';
        }else{
            $ret_code = '1';
            $ret_msg  = $msg;
            $refund_no = '';
            $amount = '';
            $refund_time ='';
            $card_no ='';
        }
        header('Content-Type: application/xml;charset=utf8');
        $result = '<?xml version="1.0" encoding="utf-8"?>
                    <response>
                        <ret_code>'.$ret_code.'</ret_code>
                        <ret_msg>'.$ret_msg.'</ret_msg>
                        <output>
                            <refund_no>'.$refund_no.'</refund_no>
                            <amount>'.$amount.'</amount>
                            <refund_time>'.$refund_time.'</refund_time>
                            <card_no>'.$card_no.'</card_no>
                        </output>
                    </response>';
        //记录日志
        $log = '';
        $log .= 'TIME:' . date('Y-m-d H:i:s') . "\n";
        $log .= 'apiName: taketicket'."\n";
        $log .= 'OUT:响应时间:'. $result . "\n";
        $log .= "\t\n";
        $rs = file_put_contents($fileName, $log, FILE_APPEND);
        //记录日志
        echo  $result;die();
    }
    /**
    *访问his接口方法
    *
    */
    protected function reqSoap($params,$apiName='',$func='',$funcTwo='')
    {
        $serverAddr = self::$SERVER_ADDR;
        $soap = new \SoapClient($serverAddr);
        $par->funCode= $apiName;
        $par->input = $params;
        if($funcTwo != '')
        {
            $par->SeachType = '';
        }
        $requestTime = time();
        $row = $soap->CommonMethod($par);
        $result =$row->CommonMethodResult;
        $responsetTime = time();
        $fileName = "Application/Runtime/Logs/HIS/his_".date('Ymd') . '.log';
        $log = '';
        $log .= 'TIME:' . date('Y-m-d H:i:s') . "\n";
        $log .= 'URL:' . $serverAddr . "\n";
        $log .= 'apiName:' . $apiName . "\n";
        $log .= 'IN:请求时间:'.$requestTime . $params . "\n";
        $log .= 'OUT:响应时间:' .$responsetTime . $result . "\n";
        $log .= "\t\n";
        $a = file_put_contents($fileName, $log, FILE_APPEND);
        // var_dump($a);exit;

        $OB_OutXmlPat = simplexml_load_string($result);
        $relPat = json_decode(json_encode($OB_OutXmlPat),true);
        if($relPat['ResultCode'] != '0'){
        	$dbData['op_name']=$apiName;
	        $dbData['op_des']=$params;
	        $dbData['op_xml']=$result;
	        $dbData['op_time']=date('Y-m-d H:i:s');
	        M('his_error')->add($dbData);
        }
        return $result;
    }
    /**
    *电子病历接口
    *
    */
    protected function reqDzblSoap($method,$param,$value)
    {
        $serverAddr = self::$DZBLSERVER_ADDR;
        $soap = new \SoapClient($serverAddr);
        
        $par->$param = $value;
        $row = $soap->$method($par);
        $resultName = $method.'Result';
        $result =$row->$resultName;

        $fileName = "Application/Runtime/Logs/HIS/his_".date('Ymd') . '.log';
        $log = '';
        $log .= 'TIME:' . date('Y-m-d H:i:s') . "\n";
        $log .= 'URL:' . $serverAddr . "\n";
        $log .= 'apiName:' . $apiName . "\n";
        $log .= 'IN:' . $params . "\n";
        $log .= 'OUT:' . $result . "\n";
        $log .= "\t\n";
        $a = file_put_contents($fileName, $log, FILE_APPEND);
        return $result;
    }
    public static function checkEmpty($value){
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if ($value == 'null')
            return true;
        if (is_array($value) && count($value) == 0)
            return true;
        if (is_string($value) && trim($value) === "")
            return true;
        return false;
    }
     /**
     *获取挂号记录
     * 2020年10月10日10:35:47
     * sgy
     * 1.增加返回数据，通过查询HIS患者信息接口(3300)
     */
    public function registerRecord($parameters='')
    {
        Log::write("挂号记录调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $hospitalCode=$reqData['hospitalCode'];
        $cardType = $reqData['treatCardType'];
        $CardNo = $reqData['treatCardNo'];
        $patientId = $reqData['patientId'];
        $StartDate = $reqData['startDate'];
        $EndDate = $reqData['endDate'];
        $devCode = $reqData['devCode'];
        // $patientId = '0004158441';//0004158441 0007630936
        // $StartDate = '2020-09-10';
        // $EndDate = '2020-09-30';
        // $hospitalCode='3';
        // 0007630936 ID 
        //000007687022 NO
        // 3 type
        switch ($cardType) {
            case '01'://yb
                $cardType='3';
                break;
            case '03'://jzk
                $cardType='2';
                break;
            case '04'://jyt
                $cardType='4';
                break;
        }
        $str = '<Request>
                    <TradeCode>3300</TradeCode>
                    <TransactionId></TransactionId>
                    <ExtOrgCode></ExtOrgCode>
                    <ClientType></ClientType>
                    <TerminalID></TerminalID>
                    <HospitalId></HospitalId>
                    <ExtUserID>'.$devCode.'</ExtUserID>
                    <PatientCard></PatientCard>
                    <CardType></CardType>
                    <PatientID>'.$patientId.'</PatientID>
                    <Phone></Phone>
                    <IDCardType></IDCardType>
                    <IDNo></IDNo>
                    <PatientName></PatientName>
                </Request>';
        $result = $this->reqSoap($str,'GetPatInfo');
        $OB_OutXmlPat = simplexml_load_string($result);
        $relPat = json_decode(json_encode($OB_OutXmlPat),true);
        // echo "<pre>";
        // var_dump($result);exit;
        if($relPat['ResultCode'] == '0')
        {
            $data = $relPat['PatInfos']['PatInfo'];
        }else
        {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => '','data' =>'');
            Log::write("挂号记录获取患者信息调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
       
        $str='<Request>
                    <TradeCode>1104</TradeCode>
                    <ExtOrgCode></ExtOrgCode>
                    <ClientType></ClientType>
                    <HospitalId>'.$hospitalCode.'</HospitalId>
                    <ExtUserID>'.$devCode.'</ExtUserID>
                    <CardType>'.$cardType.'</CardType>
                    <PatientCard>'.$CardNo.'</PatientCard>
                    <PatientID>'.$patientId.'</PatientID>
                    <StartDate>'.$StartDate.'</StartDate>
                    <EndDate>'.$EndDate.'</EndDate>
                    <TransactionId></TransactionId>
                    <AdmNo></AdmNo>
                </Request>';
        $result = $this->reqSoap($str,'QueryAdmOPReg');
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        // echo "<pre>";
        // print_r($rel);exit;
        if($rel['ResultCode'] == '0')
        {
            if(count($rel['Orders']['Order']) == count($rel['Orders']['Order'],1))
            {
                //一个记录
                $Items[]=$rel['Orders']['Order'];
            }else
            {
                //多个记录
                $Items=$rel['Orders']['Order'];
            }

            $nums = count($Items);
            $doctdata = array();//最终返回串
            for($j=0; $j < $nums; $j++)
            {   
                if($Items[$j]['SessionName'] == '上午')
                {
                    $period = '1';
                }else if($Items[$j]['SessionName'] == '下午')
                {
                    $period = '2'; 
                }else{
                    $period = '3'; 
                }
                $doctdata[$j]['diagnoseNo'] = $Items[$j]['AdmNo'];
                $doctdata[$j]['visitAddress'] = $Items[$j]['AdmitAddress'];
                $doctdata[$j]['createDate'] = $Items[$j]['RegDate'];
                $doctdata[$j]['empTitle'] = $Items[$j]['DoctorTitle'];
                $doctdata[$j]['patientId'] = $Items[$j]['PatientID'];
                $doctdata[$j]['patientName'] = $Items[$j]['PatName'];
                $doctdata[$j]['period'] = $period;
                $doctdata[$j]['visitSeq'] = $Items[$j]['SeqCode'];
                $doctdata[$j]['deptCode'] = $Items[$j]['DepartmentCode'];
                $doctdata[$j]['deptName'] = $Items[$j]['Department'];
                $doctdata[$j]['doctorName'] = $Items[$j]['Doctor'];
                $doctdata[$j]['doctorCode'] = $Items[$j]['DoctorCode'];
                $doctdata[$j]['fee'] = bcmul((int)$Items[$j]['RegFee'],100);
                $doctdata[$j]['hospitalName'] = $Items[$j]['HospitalName'];
                $doctdata[$j]['gender'] = $data['SexCode']==1?'男':'女';
                $doctdata[$j]['birthday'] = $this->birthday($data['DOB']).'岁';//计算年龄
                $doctdata[$j]['address'] = '';
                $doctdata[$j]['documentId'] = empty($data['DocumentID'])?'':$data['DocumentID']; 
                
            }
            // echo "<pre>";
            // print_r($doctdata);exit;
            $baseData = $doctdata;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '','data' => $baseData);
            Log::write("挂号记录调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }else
        {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => '','data' =>'');
            Log::write("挂号记录调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
        
    }
     /**
     *停诊接口
     * 2020-09-27 14:45
     * sgy
     * PatientID
     */
    public function closedTreatQuery($parameters='')
    {
        Log::write("停诊信息调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $hospitalCode=$reqData['hospitalCode']; 
        $devCode=$reqData['devCode']; 
        $StartDate = $reqData['startDate']; 
        $EndDate = $reqData['endDate']; 
        //写死的
        $hospitalCode = '2'; //2	北京同仁医院(南区)        3	北京同仁医院(西区) 45	北京同仁医院(东区)
        $devCode = 'rwnqzzj01';
        $StartDate = date("Y-m-d",time());
        $EndDate = date("Y-m-d",time()+3600*24*7);
        $str = '<Request>
                <TradeCode>1107</TradeCode>
                <ExtOrgCode></ExtOrgCode>
                <ClientType></ClientType>
                <HospitalId>'.$hospitalCode.'</HospitalId>
                <ExtUserID>'.$devCode.'</ExtUserID>
                <StartDate>'.$StartDate.'</StartDate>
                <EndDate>'.$EndDate.'</EndDate>
            </Request>';
        $result = $this->reqSoap($str,'QueryStopDoctorInfo');
        //写死的
        // $result = '<Response><ResultCode>0</ResultCode><ResultContent>查询成功</ResultContent><RecordCount>2</RecordCount><Schedules><StopSchedule><ScheduleCode>586||79</ScheduleCode><ServiceDate>2020-09-27</ServiceDate><TimeRangeCode>04</TimeRangeCode><TimeRangeName>全天</TimeRangeName><StartTime>00:01</StartTime><EndTime>23:59</EndTime><DepartmentCode>748</DepartmentCode><DepartmentName>眼科普通门诊(南区)</DepartmentName><DoctorCode>248</DoctorCode><DoctorName>于亚杰</DoctorName></StopSchedule><StopSchedule><ScheduleCode>7063||4040</ScheduleCode><ServiceDate>2020-09-29</ServiceDate><TimeRangeCode>01</TimeRangeCode><TimeRangeName>上午</TimeRangeName><StartTime>08:00</StartTime><EndTime>11:30</EndTime><DepartmentCode>460</DepartmentCode><DepartmentName>皮肤性病科(南区)</DepartmentName><DoctorCode>3153</DoctorCode><DoctorName>皮肤科主治医师普通号</DoctorName></StopSchedule></Schedules></Response>';
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
       
        if ($rel) 
        {
            if (count($rel['Schedules']['StopSchedule'],1) == count($rel['Schedules']['StopSchedule'])) {
                //一条数据
                $Items[]=$rel['Schedules']['StopSchedule'];
            } else {
                //多条数据
                $Items=$rel['Schedules']['StopSchedule'];
            }
            $nums = count($Items);
            $doctdata = array();//最终返回串
            // [ScheduleCode] => 586||79
            // [ServiceDate] => 2020-09-27
            // [TimeRangeCode] => 04
            // [TimeRangeName] => 全天
            // [StartTime] => 00:01
            // [EndTime] => 23:59
            // [DepartmentCode] => 748
            // [DepartmentName] => 眼科普通门诊(南区)
            // [DoctorCode] => 248
            // [DoctorName] => 于亚杰
            /*for($j=0; $j < $nums; $j++)
            {   
                if($Items[$j]['TimeRangeName'] == '上午')
                {
                    $period = '1';
                }else if($Items[$j]['TimeRangeName'] == '下午')
                {
                   $period = '2'; 
                }else{
                    $period = '3'; 
                }
                $doctdata[$j]['deptCode'] = $Items[$j]['DepartmentCode'];
                $doctdata[$j]['deptName'] = $Items[$j]['DepartmentName'];
                $doctdata[$j]['doctorName'] = $Items[$j]['DoctorName'];
                $doctdata[$j]['doctorCode'] = $Items[$j]['DoctorCode'];
                $doctdata[$j]['scheduleNo'] = $Items[$j]['ScheduleCode'];
                $doctdata[$j]['scheduleDate'] = $Items[$j]['ServiceDate'];
                $doctdata[$j]['startTime'] = $Items[$j]['StartTime'];
                $doctdata[$j]['endTime'] = $Items[$j]['EndTime'];
                $doctdata[$j]['period'] = $period;
            }*/
            header('Content-Type:application/json;charset=utf8');
            $baseData=$Items;
            // echo '<pre>';
            // print_r($baseData);exit;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '','data' => $baseData);
            Log::write("停诊信息接口内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        } else 
        {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => '');
            Log::write("停诊信息接口内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }
    /**
     *门诊电子病历接口
     * 2020-09-22 14：55
     * sgy
     * PatientID
     */
    public function electronicMedicalRecord($parameters='')
    {
        Log::write("电子病历调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $value=$reqData['patientId'];//登记号
        $method = 'GETOUTPATLIST';
        $param = 'patientid';
        $result = $this->reqDzblSoap($method,$param,$value); 
        $OB_OutXml = simplexml_load_string(mb_convert_encoding($result,'UTF-16', 'UTF-8'));
        $rel= json_decode(json_encode($OB_OutXml),true);
        
        if ($rel['STATUS'] == '1') 
        {
            if (count($rel['VISITINFOS']['VISIT'],1) == count($rel['VISITINFOS']['VISIT'])) {
                //一条数据
                $Items[]=$rel['VISITINFOS']['VISIT'];
            } else {
                //多条数据
                $Items=$rel['VISITINFOS']['VISIT'];
            }
            $ary=array();
            $nums = count($Items);
            for ($i=0; $i < $nums; $i++) 
            {   
                $ary[$i]['patientId']=is_null($Items[$i]['PATIENT_ID'])?'':$Items[$i]['PATIENT_ID'];
                $ary[$i]['hisTradeNo']=$Items[$i]['HIS_REGISTER_PK'];
                $ary[$i]['deptName']=$Items[$i]['DEPT_NAME'];
                $ary[$i]['deptCode']=$Items[$i]['DEPT_CODE'];
                $ary[$i]['doctorName']=empty($Items[$i]['DOCTOR'])?'':$Items[$i]['DOCTOR'];
                $ary[$i]['visitTime']=$Items[$i]['VISIT_TIME'];
            }
          
            header('Content-Type:application/json;charset=utf8');
            $baseData=$ary;
            // echo "<pre>";
            // print_r($baseData);exit;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '','data' => $baseData);
            Log::write("电子病历调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        } else 
        {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => $rel['ERROR'],'data' => '');
            Log::write("电子病历调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }
    /**
     *门诊电子病历接口;获取打印数据流
     * 2020-09-22 15：22
     * sgy
     * 
     */
    public function electronicMedicalPrint($parameters='')
    {
        Log::write("电子病历打印调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $value=$reqData['hisTradeNo'];//HIS流水号
        $method = 'GETFILE';
        $param = 'strNew';
        // $value = '14102183';
        $result = $this->reqDzblSoap($method,$param,$value); 
        $OB_OutXml = simplexml_load_string(mb_convert_encoding($result,'UTF-16', 'UTF-8'));
        $rel= json_decode(json_encode($OB_OutXml),true);
        
        if ($rel['STATUS'] == '1') 
        {
            if (count($rel['FILEINFOS']['FILE'],1) == count($rel['FILEINFOS']['FILE'])) {
                //一条数据
                $Items[]=$rel['FILEINFOS']['FILE'];
            } else {
                //多条数据
                $Items=$rel['FILEINFOS']['FILE'];
            }
           
            $ary=array();
            $nums = count($Items);
            $temp = array();
            for ($i=0; $i < $nums; $i++) 
            {   
                $ary['recordName']=is_null($Items[$i]['EMR_FILE_NAME'])?'':$Items[$i]['EMR_FILE_NAME'];
                $temp[$i]['devSide'] = 'baseTpdf';//电子病历打印
                $temp[$i]['strIn'] = $Items[$i]['EMR_FILE_CONTENT'];
                $temp[$i] = json_encode($temp[$i]);
            }
            $ary['fileData']  = $temp;
            header('Content-Type:application/json;charset=utf8');
            $baseData=$ary;
            // echo "<pre>";
            // print_r($baseData);exit;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '','data' => $baseData);
            Log::write("电子病历打印调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        } else 
        {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => $rel['ERROR'],'data' => '');
            Log::write("电子病历打印调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }
    /**
     *HIS报到接口 
     * 2020-09-15 17:23
     * sgy IDType=1表示传进来的是病人的卡号,否则为登记号
     * PatientID传卡号或登记号
     */
    public function checkIn($parameters='')
    {
        Log::write("HIS报到调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $hospitalCode=$reqData['hospitalCode']; //新增入参
        $treatCardNo=$reqData['treatCardNo']; //新增入参
        $devCode = $reqData['devCode'];

        if(strlen($treatCardNo) == '10')
        {
            $cardType = '2';
        }else
        {
            $cardType = '1';
        }
        $hospitalCode = '3';
        $str = '<Request>
                    <TradeCode>1301</TradeCode>
                    <ExtOrgCode></ExtOrgCode>
                    <ClientType></ClientType>
                    <HospitalId>'.$hospitalCode.'</HospitalId>
                    <ExtUserID>'.$devCode.'</ExtUserID>
                    <PatientID>'.$treatCardNo.'</PatientID>
                    <ServiceName/>
                    <IDType>'.$cardType.'</IDType>
                    <MachineID>'.$devCode.'</MachineID>
                    <ZoneID/>
                    <AdmNo/>
            </Request>'; 
        $result = $this->reqSoap($str,'OPAllocAutoReport');
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        if ($rel['ResultCode'] == '0') 
        {
            $tipArr = explode("^",$rel['Tip']);
            $tipNewArr = array();
            for($i=0; $i <count($tipArr); $i++)
            {   
                if($i%2 == 0)
                {
                    //临时演示修改 
                    if($tipArr[$i+1] == '请到候诊')
                    {
                        $tipArr[$i+1] = '请到诊区候诊';
                    }
                    //临时演示修改
                    $tipNewArr[] = $tipArr[$i].':'.$tipArr[$i+1];
                }
            }
            $partienResultData['patientId'] = $rel['PatientID'];
            $partienResultData['tip'] =  $tipNewArr;
            $partienResultData['name'] = $rel['Name'];
            $partienResultData['gender'] = $rel['Sex']=='男'?'1':'2';
            header('Content-Type:application/json;charset=utf8');
            $baseData=$partienResultData;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '','data' => $baseData);
            Log::write("报到接口内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        } else 
        {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => $rel['ErrorMsg'],'data' => '');
            Log::write("报到接口内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }
     /**
     *底方打印接口 
     * 2020-09-26 23:17  sgy
     * sgy 
     * 根据就诊号获取打印信息
     */
    public function bottomPrinting($parameters='')
    {
        Log::write("底方打印调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $diagnoseNo=$reqData['diagnoseNo']; //就诊号
        // $diagnoseNo='13738334';//1444983 13738156
        // $hospitalCode = '3';
        // $devCode = 'rwnqzzj01';
        $str=$diagnoseNo;//就诊号
        $result = $this->reqSoap($str,'GetAdmPrescInfo');
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        // echo '<pre>';
        // print_r($rel    );exit;
        if (!empty($rel['PrescInfos']))
        {
            if (count($rel['PrescInfos']['PrescInfo'],1) == count($rel['PrescInfos']['PrescInfo'])) {
                //一条数据
                $Items[]=$rel['PrescInfos']['PrescInfo'];
            } else {
                //多条数据
                $Items=$rel['PrescInfos']['PrescInfo'];
            }
            $nums = count($Items);
            $printData = array();//原始打印数据
            $combineStrArr = array();//合并key后的打印数据
            $diagnosisArr = array();//诊断信息
            $drugListArr = array();//药品信息
            $returnData = array();//最终返回串
            $drugStrArr = array();//分解的药品信息串
            //
            $keyArr =['fee','extends','date','time','drugList','tips','ptFlag','diagnosis','deptName','docName','acceptRoom','isChildren','prescType','every'];//底方打印字段的Key acceptRoom 接收科室  isChildren 儿科标识 新增  prescType 病人性质字段 
            $drugKeyArr = ['itemName','unit','frequency','usage'];//药品的Key
            for($i=0; $i <$nums; $i++)
            {   
                $printData= explode("!", $Items[$i]['Info']); 
                $combineStrArr =  array_combine($keyArr,$printData);
                foreach($combineStrArr as $key=> $value)
                {
                    
                    if($key == 'drugList' )
                    {
                        $drugListArr = explode("@", $value);
                        for($x=0; $x <count($drugListArr); $x++)
                        {
                            $drugStrArr = explode(";", $drugListArr[$x]);
                            $drugStrArr =  array_combine($drugKeyArr,$drugStrArr);
                            $drugListArr[$x] = $drugStrArr;
                        }
                        $combineStrArr[$key] = $drugListArr;
                    }elseif( $key == 'diagnosis')
                    {
                        $diagnosisArr = explode("@", $value);
                        $combineStrArr[$key] = $diagnosisArr;
                    }else if( $key == 'deptName')
                    {
                        //截取科室的'-'之前的字母
                        $combineStrArr[$key] = substr($value,strpos($value,"-")+1);
                    }
                
                }
                $returnData[$i] = $combineStrArr;
                $returnData[$i]['recipeNo'] =  $Items[$i]['PrescNo'];//处方号
            }
            header('Content-Type:application/json;charset=utf8');
            $baseData=$returnData;
            
            // echo '<pre>';
            // print_r($baseData);exit;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '','data' => $baseData);
            Log::write("底方打印接口内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        } else 
        {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => array());
            Log::write("底方打印接口内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }
    /**
     * 京医通卡管理
     * jyCardManagement
     * 2020-09-08
     * sgy
     *  */ 
    public function jytCardManagement($parameters='')
    {
        Log::write("京医通卡管理内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $treatCardNo=$reqData['treatCardNo']; //京医通卡片信息
        $patientType=$reqData['patientType'];
        $name=$reqData['name'];
        $idNo=$reqData['idNo'];
        $idType=$reqData['idType'];
        $gender=$reqData['gender'];
        $birthday=str_replace('-','',$reqData['birthday']);
        $idNo=$reqData['idNo'];
        $insurCardNo=$reqData['insurCardNo'];
        $address=$reqData['address'];
        $mobile=$reqData['mobile'];
        $devCode=$reqData['devCode'];
        $businessType = $reqData['businessType'];//1 建卡  2 退卡 新增入参
        $xml = trim($reqData['jytXml']);//京医通流水号信息
        $data = simplexml_load_string(mb_convert_encoding(htmlspecialchars_decode($xml), 'UTF-16', 'UTF-8'));
        $jytInfo = json_decode(json_encode($data),true);
        if($jytInfo['state']['@attributes']['success'] == true)
        {
            $jytTradeNo = $jytInfo['tradeno'];
        }else
        {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => '获取京医通流水号失败','data' => '');
            Log::write("京医通卡管理内部调用失败处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
        //解析出京医通卡号
        if($treatCardNo != '')
        {
            $jytInfo = $this->jytJieXi($treatCardNo);
            $treatCardNo=$jytInfo['card_no'];
        }
        if($businessType == '1')
        {
            $returnXml = '<?xml version="1.0" encoding="utf-16"?><root sender="HIS"><tradeno>'.$jytTradeNo.'</tradeno><clienttype>2</clienttype><tradesubclass>0101</tradesubclass><cardinfo><medicalalliancecode></medicalalliancecode><idtype>1</idtype><idno>'.$idNo.'</idno><name>'.$name.'</name><sex>'.$gender.'</sex><birthday>'.$birthday.'</birthday><nationality>1</nationality><phone>'.$mobile.'</phone><recordaddress>'.$address.'</recordaddress><presentaddress>'.$address.'</presentaddress><countryinfo>1</countryinfo><marriageinfo>1</marriageinfo><localityinfo>1</localityinfo><unit></unit><areacode>110101</areacode><contactname>'.$name.'</contactname><contactsex>1</contactsex><contactidtype>1</contactidtype><contactidno>'.$idNo.'</contactidno><contactphone>'.$mobile.'</contactphone><contactpresentaddress>中文</contactpresentaddress><deposit>0.00</deposit><photo></photo></cardinfo><operator><id>'.$devCode.'</id><name>'.$devCode.'</name></operator></root>';
        }else
        {
            $returnXml = '<?xml version="1.0" encoding="utf-16"?><root sender="HIS"><cardno name="京医通卡号">'.$treatCardNo.'</cardno><tradeno name= "交易流水号">'.$jytTradeNo.'</tradeno><clienttype name="客户端类型，1-HIS，2-自助终端，3-首信客户端">2</clienttype><brokeridtype name="代理人证件类型">1</brokeridtype><brokeridno name="代理人证件号码">'.$idNo.'</brokeridno><brokername name="代理人姓名">'.$name.'</brokername><operator name="操作员信息"><id name="操作员编号">'.$devCode.'</id><name name="操作员姓名">'.$devCode.'</name></operator></root>';
        }
        $baseData = $returnXml;
        header('Content-Type:application/json;charset=utf8');
        $result = array('code' => 0,'msg' => '成功','data' => $baseData);
        Log::write("京医通卡管理调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
        return $result;
    }
    /*
    *解析打印数据
    *
    */
    public function inspection($parameters=''){
        Log::write("获取检验报告打印列表内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $Outstr=$parameters['repXml'];
        $OutstrT = htmlspecialchars_decode($Outstr);
        $xml     = simplexml_load_string($OutstrT);
        $rel  = json_decode(json_encode($xml),true);
        $printList = array();
        if($rel['Table1']['ErrorID'] == 0)
        {
            if($rel['Table2']['SampleNo'] != "")
            {
                $printList[]= $rel['Table2'];
            }else{
                $printList  = $rel['Table2'];
            }
            
            $nums = count($printList);
            $baseData = array();
            $details = array();
            $printNums = 0;//可打印
            $unPrintNums = 0;//测试中
            $printedNums = 0;//已打印
            $dPrintTime = date("Y-m-d H:i:s");
            for ($i=0; $i < $nums; $i++) 
            { 
                if($printList[$i]['SampleState'] == '800' && $printList[$i]['PrintOutOfLabFlag'] == '0')
                {
                    $priStr['SampleNo'] =$printList[$i]['SampleNo'];
                    $priStr['nPreview'] = 0; 
                    $printFlagStr['nSampleNo'] =$printList[$i]['SampleNo'];
                    $printFlagStr['dPrintTime'] = $dPrintTime; 
                    $details[$printNums]['sheetId'] = $printList[$i]['SampleNo'];
                    $details[$printNums]['sheetName'] = $printList[$i]['RequestItemSummary'];
                    $details[$printNums]['checkDate'] = '';
                    $details[$printNums]['sheetStatus'] = $printList[$i]['SampleState']=='800'?"1":"0";
                    $details[$printNums]['printInStr'] = json_encode($priStr);
                    $details[$printNums]['printFlagStr'] = json_encode($printFlagStr);
                    $printNums++;
                }else if($printList[$i]['SampleState'] == '800' && $printList[$i]['PrintOutOfLabFlag'] == '1')
                {
                    $printedNums++;
                }
                else if($printList[$i]['SampleState'] != '800' )
                {
                    $unPrintNums++;
                }
            }
            $baseData['patientName'] = $printList[0]['PatientName'];
            $baseData['printNums'] = $printNums;
            $baseData['unPrintNums'] = $unPrintNums;
            $baseData['printedNums'] = $printedNums;
            $baseData['item'] = $details;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => $rel['Table1']['ErrorString'],'data' => $baseData);
            Log::write("获取报告打印内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }else
        {
            $baseData['patientName'] = '';
            $baseData['printNums'] = '';
            $baseData['unPrintNums'] = '';
            $baseData['printedNums'] = '';
            $baseData['item'] = array();
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => '','data' =>$baseData);
            Log::write("获取报告打印内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }
    /**
     * 获取患者待缴费信息
     *payQuery
     */
    public function payQuery($parameters = '')
    {
        Log::write("获取缴费列表内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $patientId=$reqData['patientId'];
        $cardType=$reqData['treatCardType'];
        $CardNo=$reqData['treatCardNo'];
        $devCode=$reqData['devCode'];
        $startDate=date("Y-m-d",time()-2*24*3600);
        // $startDate=date("Y-m-d",time());
        $endDate=date("Y-m-d",time());
        switch ($cardType) {
            case '01'://yb
                $cardType='3';
                break;
            case '03'://jzk
                $cardType='2';
                break;
            case '04'://jyt
                $cardType='4';
                break;
        }
        $str='<Request>
                <TradeCode>4902</TradeCode>
                <HospitalID></HospitalID>
                <CardNo>'.$CardNo.'</CardNo>
                <CardType>'.$cardType.'</CardType>
                <SecrityNo>0</SecrityNo>
                <PatientID>'.$patientId.'</PatientID>
                <UserCode>'.$devCode.'</UserCode>
                <TerminalID>'.$devCode.'</TerminalID>
                <StartDate>'.$startDate.'</StartDate>
                <EndDate>'.$endDate.'</EndDate>
                <ExpStr></ExpStr>
        </Request>';
        $result = $this->reqSoap($str,'ZZJCommonPay'); 
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        if ($rel['ResultCode'] == '0') {
            if (count($rel['AdmList']['AdmItem'],1) == count($rel['AdmList']['AdmItem'])) {
                //一条数据
                $Items[]=$rel['AdmList']['AdmItem'];
            } else {
                //多条数据
                $Items=$rel['AdmList']['AdmItem'];
            }
            $datarow_attr_ary = array();
            $datarow_attr_ary['recipeArr'] = array();
            for ($j=0; $j < count($Items); $j++){ 
                $datarow_attr_ary['totalFee'] += $Items[$j]['AdmAmt'];
                $datarow_attr_ary['payDate']   = $Items[$j]['AdmDate'];
                $str='<Request>
                            <TradeCode>4904</TradeCode>
                            <HospitalID></HospitalID>
                            <CardNo>'.$CardNo.'</CardNo>
                            <CardType>'.$cardType.'</CardType>
                            <SecrityNo>0</SecrityNo>
                            <PatientID>'.$patientId.'</PatientID>
                            <UserCode>'.$devCode.'</UserCode>
                            <TerminalID>'.$devCode.'</TerminalID>
                            <StartDate>'.$startDate.'</StartDate>
                            <EndDate>'.$endDate.'</EndDate>
                            <ExpStr></ExpStr>
                            <Adm>'.$Items[$j]['Adm'].'</Adm>
                        </Request>';
                $result = $this->reqSoap($str,'ZZJCommonPay'); 
                $OB_OutXml = simplexml_load_string(trim($result));
                $rel_s = json_decode(json_encode($OB_OutXml),true);
                $payOrderArr = $rel_s['PayOrdList']['PayOrder'];
                if (!is_array(current($payOrderArr))) {
                    $rel_s['PayOrdList']['PayOrder'] = array($payOrderArr);
                    if(!is_array(current($payOrderArr['ItemList']['Item']))){
                        $payOrderArr['ItemList']['Item'] = array($payOrderArr['ItemList']['Item']);
                        $rel_s['PayOrdList']['PayOrder'] = array($payOrderArr);
                    }
                }else{
                    for ($i=0; $i <count($payOrderArr) ; $i++) { 
                        if(!is_array(current($payOrderArr[$i]['ItemList']['Item']))){
                            $payOrderArr[$i]['ItemList']['Item'] = array($payOrderArr[$i]['ItemList']['Item']);
                            $rel_s['PayOrdList']['PayOrder'] = $payOrderArr;
                        }
                    }   
                }

                foreach ($rel_s['PayOrdList']['PayOrder'] as $key => $val) {
                    $Details = $val['ItemList']['Item'];
                    $nums = count($Details);
                    $ary  = array();
                    $freeFee = 0;
                    for ($i=0; $i < $nums; $i++) {   
                        
                        $ary[$i]['itemNo']        = $Details[$i]['ItemCode'];
                        $ary[$i]['fee']           = $Details[$i]['ItemSum'];
                        $ary[$i]['itemType']      = ''; // 暂无
                        $ary[$i]['itemName']      = $Details[$i]['ItemName'];
                        $ary[$i]['billsType']     = ''; // 暂无
                        $ary[$i]['unitPrice']     = $Details[$i]['ItemPrice'];
                        $ary[$i]['count']         = $Details[$i]['ItemQty'];
                        $ary[$i]['specification'] = $Details[$i]['ItemSpecs'];
                        $ary[$i]['unit']          = $Details[$i]['ItemUom'];
                    }

                    $attr_ary['diagnoseNo']   = $Items[$j]['Adm'];
                    $attr_ary['recipeDate']   = $Items[$j]['AdmDate'];
                    $attr_ary['deptName']     = $Items[$j]['AdmDept'];
                    $attr_ary['doctorName']   = $Items[$j]['AdmDoctor'];
                    $attr_ary['recipeFeeHis'] = $val['OrderSum'];//此字段为传递给HIS所用，如果传减去新冠之后的金额，HIS会报金额不对的错误；
                    $attr_ary['recipeNo']     = $val['OrderNo']; // 处方序号
                    $attr_ary['recipeFee']    = $val['OrderSum'];//bcsub($val['OrderSum'],$freeFee,2);// 将收费金额减去新冠收费的金额
                    $attr_ary['itemArr']      = $ary;

                    if (in_array($val['OrderInsType'], self::$feeTypeArr)) {
                        $attr_ary['isPayCode']   = '1';
                        $attr_ary['isPayMsg']    = '您的处方中包含特病、特药，请到专用窗口缴费';
                    }else{
                        $attr_ary['isPayCode']   = '0';
                        $attr_ary['isPayMsg']    = '允许缴费';
                    }
                    /* 
                    2020年11月1日12:44:26
                    邵冠亚
                    核酸检测
                    如果OrderInsType 存在核酸检测这几个字 则增加标志回传给后台
                    自费患者不收费  医保患者将医保报销后的金额进行免费处理
                    医保患者未过起步线患者全额免费处理
                    */
                    if (strpos($val['OrderInsType'],'核酸检测')) 
                    {
                        //此时给前段回传一个新冠免费标志
                        $attr_ary['xgFlag']   = '1';// 1代表此时免费
                    }else
                    {
                        $attr_ary['xgFlag']   = '0';// 0代表此时正常处理
                    }
                    array_push($datarow_attr_ary['recipeArr'], $attr_ary);
                }
                // $attr_ary['chufangArr'] = $chufang_arr;
            }
            $baseData = $datarow_attr_ary;
            // echo "<pre>";
            // print_r($baseData);exit;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '成功','data' => $baseData);
            Log::write("获取缴费列表内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }else {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => '');
            Log::write("获取缴费列表内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }
    /**OK
    *缴费划价接口 
    *
    */
    public function payLock($parameters = '') {
        Log::write("获取缴费划价内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData = $parameters;
        $recipeNo = $reqData['recipeNos'];
        $patientId = $reqData['patientId'];
        $cardType = $reqData['treatCardType'];
        $CardNo = $reqData['treatCardNo'];
        $feeData = $reqData['feeData'];
        // $chargeTotal = $feeData[0]['orderFee'];
        $chargeTotal = $feeData[0]['orderFeeHis'];//2020年10月9日15:56:07 sgy 此处修改为将新冠检查的费用进行抹除后，传递给HIS会报错；实际上金额是抹除了，但是传递给HIS需要时未抹除的金额 
        $diagnoseNo = $feeData[0]['diagnoseNo'];
        $hisResult = $reqData['hisResult'];
        $devCode = $reqData['devCode'];
        $xgFlag =  $feeData[0]['xgFlag'];//新冠检测标志
        switch ($cardType) {
            case '01'://yb
                $cardType='3';
                break;
            case '03'://jzk
                $cardType='2';
                break;
            case '04'://jyt
                $cardType='4';
                break;
        }
        //解析医保返回
        if($cardType == '3') 
        {
            if (substr($hisResult,0,1) == '0') 
            {
                $ybInfo=$this->jieXi($hisResult,'YYT_YB_SF_CALC');
                $rel['ResultCode'] = '0';
            } else 
            {
                header('Content-Type:application/json;charset=utf8');
                $result = array('code' => 1,'msg' => '医保分解返回失败,请去窗口处理！','data' => '');
                Log::write("获取缴费划价内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            }
        }else{
            $str='<Request>
                    <TradeCode>4905</TradeCode>
                    <HospitalID></HospitalID>
                    <CardNo>'.$CardNo.'</CardNo>
                    <CardType>'.$cardType.'</CardType>
                    <SecrityNo>0</SecrityNo>
                    <PatientID>'.$patientId.'</PatientID>
                    <UserCode>'.$devCode.'</UserCode>
                    <TerminalID>'.$devCode.'</TerminalID>
                    <Adm>'.$diagnoseNo.'</Adm>
                    <OrderNo>'.$recipeNo.'</OrderNo>
                    <OrderSum>'.$chargeTotal.'</OrderSum>
                    <PayModeCode>QT</PayModeCode>
                    <ExpStr></ExpStr>
            </Request>';
            $result = $this->reqSoap($str,'ZZJCommonPay'); 
            $OB_OutXml = simplexml_load_string($result);
            $rel = json_decode(json_encode($OB_OutXml),true);
        }
        if ($rel['ResultCode'] == '0'){
            $datarow['payReceiptNo']=$cardType==3?$ybInfo['InvprtDr']:$rel['InvoiceList']['Invoice']['InvoiceNo'];
            $datarow['medTradeNo']=$diagnoseNo;
            $datarow['chargeTotal']= bcmul($chargeTotal,100);
            //新冠免费项目不收费
            if($xgFlag == '1')
            {
                //不收费
                $datarow['cash']=0;
                $datarow['xgYouHuiFee'] = $cardType==3?bcmul($ybInfo['cash'],100):bcmul($rel['InvoiceList']['Invoice']['InvoiceAmt'],100);
            }else
            {
                //正常收费
                $datarow['cash']=$cardType==3?bcmul($ybInfo['cash'],100):bcmul($rel['InvoiceList']['Invoice']['InvoiceAmt'],100);
            }
            $datarow['insurFee']= $cardType==3?bcmul($ybInfo['fund'],100):0;
            $datarow['insurAccountPay']= $cardType==3?bcmul($ybInfo['personcountaftersub'],100):0;
            $baseData=$datarow;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '成功','data' => $baseData);
            Log::write("获取缴费划价内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }else{
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => $rel['ResultMsg'],'data' => '');
            Log::write("获取缴费划价内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }
    /**OK
    * 缴费支付确认
    * 
    */
    public function payConfirm($parameters = '') {
        Log::write("获取缴费保存内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $hospitalCode=$reqData['hospitalCode']; //新增入参
        $patientId=$reqData['patientId']; //新增入参
        //支付信息
        $cash = $reqData['cash'];
        $payType = $reqData['payType'];
        $tradeNo = $reqData['tradeNo'];
        $outTradeNo = $reqData['outTradeNo'];
        $payCardNo = $reqData['payCardNo'];
        $payTime = $reqData['payTime'];//待分割
        //HIS信息
        $payReceiptNo = $reqData['payReceiptNo'];
        $orderNos = $reqData['orderNos'];
        $CardNo = $reqData['treatCardNo'];
        $cardType = $reqData['treatCardType'];
        $InvoiceNoStr = $reqData['payReceiptNo'];
        $hisResult = $reqData['hisResult'];
        $devCode = $reqData['devCode'];
        //新冠患者将优惠金额传递给HIS 
        $feeData = $reqData['feeData'];
        $xgFlag = $feeData[0]['xgFlag'];
        $xgYouHuiFee = $reqData['xgYouHuiFee'];
        $resultStr = $reqData['resultStr'];//银行支付串
        //新冠新冠患者将优惠金额传递给HIS
        $PayDate=date("Y-m-d",time());
        $PayTime=date("H:i:s",time());
        switch ($cardType) {
            case '01'://yb
                $cardType='3';
                break;
            case '03'://jzk
                $cardType='2';
                break;
            case '04'://jyt
                $cardType='4';
                break;
        }
        //支付方式
        // ZZJJYT	自助机京医通  HIS
        // MISSCAN	自助机POS通
        // MISPOS	自助机银行卡
        // 1 微信支付 2支付宝 3-银联 4-京医通余额  9免费 我方
        switch ($payType) 
        {
            case '1':
                $payType='MISSCAN';
                break;
            case '2':
                $payType='MISSCAN';
                break;
            case '3':
                $payType='MISPOS';
                break;
            case '4':
                $payType='ZZJJYT';
                break;
            case '9':
                $payType='QT';
                break;
        }
        /* 
            新冠支付方式传递 YJJJ
        */
        if($xgFlag == '1')
        {
            $payType = 'YYDF';//新冠记账支付方式
            $cash =  bcdiv($xgYouHuiFee,100);//将记账金额传给HIS记账
        }
        //如果是京医通余额和医保卡余额不需要传输交易信息  sgy
        if($payType == 'MISSCAN' || $payType == 'MISPOS' )
        {
            if($payType == 'MISSCAN')
            {
                 //取B扫C的参数 relData
                $transactionTime=$reqData['relData']['transactionTime'];//交易时间
                $transactionDate=$reqData['relData']['transactionDate'];//交易日期
                $retrievalRefNum=$reqData['relData']['retrievalRefNum'];//检索参考号
                $transactionAmount=str_pad($reqData['relData']['transactionAmount'],12,"0",STR_PAD_LEFT);//交易金额
            }else
            {
                 //取银行卡的参数 
                $resultStrArr = explode(',',$resultStr);
                $transactionTime=$resultStrArr[7];//交易时间
                $transactionDate=$resultStrArr[6];//交易日期
                $retrievalRefNum=$resultStrArr[8];;//检索参考号
                $transactionAmount=$resultStrArr[3];;//交易金额
            }
            // old 32位空格+6位金额+69位空格+4位交易日期+6位交易时间+12位交易参考号  
            //新规则在 1000 处查看
            $POSPayStr = '00                              '.$transactionAmount.'                                                                     '.$transactionDate.$transactionTime.$retrievalRefNum.'                                                                                                                                                                                                                                                                                                                                                                                          ';
        }else
        {
            $POSPayStr = '';
        }
        //解析医保返回
        if($cardType == '3') {
            if (substr($hisResult,0,1) == '0') {
                $ybInfo=$this->jieXi($hisResult,'YYT_YB_SF_SAVE');
            } else {
                header('Content-Type:application/json;charset=utf8');
                $result = array('code' => 1,'msg' => '失败','data' => '');
                Log::write("获取已缴费明细信息调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            }
        }
        /**
         * 2020年10月27日10:54:02
         * HIS种世宇说在POSPayStr为空的时候
         * PlatformNo和OutPayNo 一样的传参
         */
        $str='<Request>
                <TradeCode>4906</TradeCode>
                <HospitalId>'.$hospitalCode.'</HospitalId>
                <CardNo>'.$CardNo.'</CardNo>
                <CardType>'.$cardType.'</CardType>
                <SecrityNo>0</SecrityNo>
                <PatientID>'.$patientId.'</PatientID>
                <UserCode>'.$devCode.'</UserCode>
                <TerminalID></TerminalID>
                <OrderNo>'.$orderNos.'</OrderNo>
                <InvoiceNoStr>'.$InvoiceNoStr.'</InvoiceNoStr>
                <PayDetails>
                    <PayModeCode>'.$payType.'</PayModeCode>
                    <TradeChannel>RWZB</TradeChannel>
                    <PayAccountNo>'.$payCardNo.'</PayAccountNo>
                    <PayAmt>'.$cash.'</PayAmt>
                    <PlatformNo>'.$tradeNo.'</PlatformNo>
                    <OutPayNo>'.$tradeNo.'</OutPayNo>
                    <PayChannel>RWZB</PayChannel>
                    <POSPayStr>'.$POSPayStr.'</POSPayStr>
                    <PayDate>'.$PayDate.'</PayDate>
                    <PayTime>'.$PayTime.'</PayTime>
                </PayDetails>
        </Request>';
        $result = $this->reqSoap($str,'ZZJCommonPay'); 
        Log::write("获取缴费保存内部调用his发送：" . var_export($str, true), '', $type = '', $destination = self::$LOGS_PATH);     
        //$result = '<Response><ResultCode>0</ResultCode><ResultMsg>确认完成成功</ResultMsg></Response>';
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        // 执行成功
        if ($rel['ResultCode'] == '0') 
        {
            $str = '<Request>
                    <TradeCode>4908</TradeCode>
                    <HospitalID></HospitalID>
                    <CardNo>'.$CardNo.'</CardNo>
                    <CardType>'.$cardType.'</CardType>
                    <SecrityNo>0</SecrityNo>
                    <PatientID>'.$patientId.'</PatientID>
                    <UserCode>'.$devCode.'</UserCode>
                    <TerminalID>'.$devCode.'</TerminalID>
                    <StartDate></StartDate>
                    <EndDate></EndDate>
                    <Adm></Adm>
                    <OrderNo>'.$orderNos.'</OrderNo>
                    <InvoiceNo></InvoiceNo>
                    <PrtInvNo></PrtInvNo>
                    <ExpStr></ExpStr>
            </Request>';
            $result =  $this->reqSoap($str,'ZZJCommonPay'); 
            //$result = '<Response><ResultCode>0</ResultCode><ResultMsg>获取缴费记录明细成功</ResultMsg><RecordCount>1</RecordCount><RecordList><Record><OrderNo>20200925122453BJTR0168</OrderNo><InvoiceNo>31999595</InvoiceNo><InvDate>2020-09-25</InvDate><InvTime>13:23:47</InvTime><DurgWin></DurgWin><TotalAmt>1.88</TotalAmt><InsuShareAmt></InsuShareAmt><PatShareAmt>1.88</PatShareAmt><PayModeInfo>其它:1.88</PayModeInfo><PrintFlag>Y</PrintFlag><PrtInvNo>54040019941141</PrtInvNo><AdmDate>2020-09-25</AdmDate><AdmTime>12:01:23</AdmTime><AdmDept>YKPTMZNQ-眼科普通门诊(南区)</AdmDept><AdmDoctor>李丽（05509）</AdmDoctor><ItemList><Item><ItemCode>CL005192</ItemCode><ItemName>注射器【【计费项】一次性使用无菌注射器(5ml)】</ItemName><ItemCategory>卫生材料费</ItemCategory><ItemRecDept>YKPTMZNQ-眼科普通门诊(南区)</ItemRecDept><ItemPrice>0.3800</ItemPrice><ItemQty>1</ItemQty><ItemSum>.38</ItemSum><ItemUom>支</ItemUom></Item><Item><ItemCode>CL005200</ItemCode><ItemName>注射器【【计费项】一次性使用无菌溶药注射器(50ml)】</ItemName><ItemCategory>卫生材料费</ItemCategory><ItemRecDept>YKPTMZNQ-眼科普通门诊(南区)</ItemRecDept><ItemPrice>1.5000</ItemPrice><ItemQty>1</ItemQty><ItemSum>1.5</ItemSum><ItemUom>支</ItemUom></Item></ItemList></Record></RecordList></Response>';
            $OB_OutXml = simplexml_load_string($result);
            $rel_s = json_decode(json_encode($OB_OutXml),true);
        //    dump($rel_s);
            if ($rel_s['ResultCode'] == '0') 
            {
                //缴费确认返回字段
                $datarow['strInvprtDr']= $ybInfo['strInvprtDr'];//医保完成后回传的编号
                $datarow['cash']= $rel_s['RecordList']['Record']['PatShareAmt'];
                $datarow['insurPersonCount']= $cardType==3?bcmul($ybInfo['personcountaftersub'],100):0;
                $datarow['paidDate']= $rel_s['RecordList']['Record']['InvDate'];
                //处方单数据信息
                $datarow['recipeArr']['recipeNo'] = $rel_s['RecordList']['Record']['OrderNo'];
                $datarow['recipeArr']['recipeDate'] = $rel_s['RecordList']['Record']['InvDate'];
                $datarow['recipeArr']['recipeFee'] = $rel_s['RecordList']['Record']['TotalAmt'];
                $datarow['recipeArr']['dispensingWindow'] = $rel_s['RecordList']['Record']['DurgWin'];
                $datarow['recipeArr']['deptName'] = $rel_s['RecordList']['Record']['AdmDept'];
                $datarow['recipeArr']['doctorName'] = $rel_s['RecordList']['Record']['AdmDoctor'];
        
                //处方明细
                if (count($rel_s['RecordList']['Record']['ItemList']['Item'],1) == count($rel_s['RecordList']['Record']['ItemList']['Item'])) 
                {
                    //一条数据
                    $Details[]=$rel_s['RecordList']['Record']['ItemList']['Item'];
                } else 
                {
                    //多条数据
                    $Details=$rel_s['RecordList']['Record']['ItemList']['Item'];
                }
                         
                $nums=count($Details);
                for ($i=0; $i < $nums; $i++) 
                {   
                    $ary[$i]['itemNo']= $Details[$i]['ItemCode'];
                    $ary[$i]['itemType']= $Details[$i]['ItemCategory'];  //暂无
                    $ary[$i]['itemName']= $Details[$i]['ItemName'];
                    $ary[$i]['billsType']='';//暂无
                    $ary[$i]['unitPrice']=$Details[$i]['ItemPrice'];
                    $ary[$i]['count']=$Details[$i]['ItemQty'];
                    $ary[$i]['fee']=$Details[$i]['ItemSum'];
                    $ary[$i]['specification']=$Details[$i]['ItemSpecs'];
                    $ary[$i]['unit']=$Details[$i]['ItemUom'];
                }
                $datarow['recipeArr']['itemArr'] = $ary;
                $baseData=$datarow;
                header('Content-Type:application/json;charset=utf8');
                $result = array('code' => 0,'msg' => '成功','data' => $baseData);
                Log::write("获取缴费保存内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            }else {
                header('Content-Type:application/json;charset=utf8');
                $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => '');
                Log::write("获取已缴费明细信息调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            }
        } else 
        {
            header('Content-Type:application/json;charset=utf8');
            $datarow['isCanRefund']='0';
            $baseData=$datarow;
            $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => $baseData);
            Log::write("获取缴费保存内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }
    protected function jytJieXi($xml)
    {
    	//1.京余额
        //2.暂定
        $doc = simplexml_load_string(mb_convert_encoding(htmlspecialchars_decode($xml), 'UTF-16', 'UTF-8'));
    	$state = (array)$doc->state;
	    $netinfo = (array)$doc->cardinfo->netinfo;
	    $cardinfo = (array)$doc->cardinfo;
	    $cardtype = $cardinfo['cardtype'];//1是京医通卡，2是医保卡
	    //success判断医保卡是否读卡成功 
	    //$netinfo['islocalblacklist']是否查询本地黑名单
        //$netinfo['reportloststatus'] 黑名单状态 0-未挂失，不在黑名单，1-正式挂失,2-临时挂失，3.已退卡，4.已冻结
		if($cardtype=="1" && $state["@attributes"]['success']=="true" && $netinfo['islocalblacklist']=="false" && $netinfo['reportloststatus']=="0" )
		{
            //1 京医通卡
			if(array_key_exists('warning',$state))
			{
				$war = (array)$state['warning'];
				$info = $war['@attributes']['info'];
			}
			$jytInfo['card_no'] = $cardinfo['cardno'];
            $jytInfo['balance'] = $cardinfo['balance'];
            $jytInfo['sex'] = $cardinfo['sex'];
            $jytInfo['idno'] = $cardinfo['idno'];
            $jytInfo['name'] = $cardinfo['name'];
            $jytInfo['birthday'] = $cardinfo['birthday'];
            $jytInfo['info'] = $info;
            
		}else if($cardtype=="2" && $state["@attributes"]['success']=="true" && $state["@attributes"]['needconfirm']=="false"  && $netinfo['accountstatus']=="1" )
		{
            //2 医保卡
			//已经有京医通账户
			$jytInfo['balance'] = $cardinfo['balance'];
			$jytInfo['card_no'] = $cardinfo['cardno'];//2020年10月30日18:05:46 为了后台京医通扣费 由空变为 京医通
            $jytInfo['info'] = '';
        }else if($cardtype=="2" && $state["@attributes"]['success']=="true" && $state["@attributes"]['needconfirm']=="false"  && $netinfo['accountstatus']!="1")
        {
            //无京医通账户
            $jytInfo['balance'] = '0.00';
        }
        return $jytInfo;
    }	
    /**OK
    * 查询患者信息
    *新增 jytXml  入参
    */
    public function patientQuery($parameters = ''){
        Log::write("查询患者内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $hospitalCode=$reqData['hospitalCode'];
        $treatCardType=$reqData['treatCardType'];
        $treatCardNo=$reqData['treatCardNo'];
        $devCode=$reqData['devCode'];
        $idNo=$reqData['idNo'];
        $businessType=$reqData['businessType'];
        $name=$reqData['name'];
        $patXml=$reqData['patXml'];// 医保患者信息入参
        $jytXml=$reqData['jytXml'];// 京医通信息入参
        // $devCode = 'rwnqzzj13';
        switch ($treatCardType) 
        {
            case '01'://yb
                $treatCardType='3';
                break;
            case '03'://jzk
                $treatCardType='2';
                break;
            case '04'://jyt
                $treatCardType='4';
                break;
        }
        //解析医保返回
        if($treatCardType == '3') 
        {
            // if (substr($patXml,0,1) == '0') 
            // {
                $ybInfo=$this->jieXi($patXml,'YYT_YB_GET_PATI');
                $treatCardNo = $ybInfo['treatCardNo'];
            // } else 
            // {
            //     header('Content-Type:application/json;charset=utf8');
            //     $partienResultData['isCreate']=1;
            //     $baseData=$partienResultData;
            //     $result = array('code' => 1,'msg' => '医保读取信息失败','data' => $baseData);
            //     Log::write("获取患者信息内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            //     return $result;
            // }
        } 
        $jytInfo = $this->jytJieXi($jytXml);
        //当业务类型是建档关联的时候；解析京医通卡返回；当业务是其他类型的时候，传入的是京医通的卡号
        if($businessType == 'ZZJK')
        {
            $treatCardNo = $jytInfo['card_no'];
        }
        //解析京医通结束
        $str = '<Request>
                <TradeCode>3300</TradeCode>
                <TransactionId></TransactionId>
                <ExtOrgCode></ExtOrgCode>
                <ClientType></ClientType>
                <TerminalID></TerminalID>
                <HospitalId>'.$hospitalCode.'</HospitalId>
                <ExtUserID>'.$devCode.'</ExtUserID>
                <PatientCard>'.$treatCardNo.'</PatientCard>
                <CardType>'.$treatCardType.'</CardType>
                <PatientID></PatientID>
                <Phone></Phone>
                <IDCardType>01</IDCardType>
                <IDNo>'.$idNo.'</IDNo>
                <PatientName>'.$name.'</PatientName>
        </Request>';
        $result = $this->reqSoap($str,'GetPatInfo');
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        if ($rel['ResultCode'] == '0') {
            //证件类型对照
            $idTypeArr =[   
                '1'=>'1',
                '2'=>'8',
                '3'=>'6',
                '4'=>'2',
                '5'=>'7',
                '6'=>'4',
                '7'=>'5',
                '8'=>'99'
            ];
            $data = $rel['PatInfos']['PatInfo'];
            $partienResultData = array();
            $partienResultData['compleste'] = '1';
            $partienResultData['patientId'] = $data['PatientID'];
            $partienResultData['hosCardNo'] = $treatCardNo;
            $partienResultData['name'] = $data['PatientName'];
            $partienResultData['gender'] = $data['SexCode']==1?'男':'女';
            $partienResultData['birthday'] = $data['DOB'];
            $partienResultData['address'] = '';
            $partienResultData['mobile'] = $data['TelephoneNo'];
            $partienResultData['insurCardNo'] = $data['InsureCardNo'];
            $partienResultData['idNo'] = $data['IDNo'];
            $partienResultData['idType'] = $idTypeArr[$data['IDTypeCode']];
            $partienResultData['mobile'] = $data['TelephoneNo'];
            $partienResultData['patientType'] = $data['PatType'];

            if($treatCardType == '3' && $patXml != '') 
            {
                $partienResultData['YbBalance'] = $ybInfo['personcount'];//个人账户余额
                $partienResultData['persontype'] = $ybInfo['persontype'];//参保人员类别
                $partienResultData['isinredlist'] = $ybInfo['isinredlist'];//是否在红名单
                $partienResultData['isspecifiedhosp'] = $ybInfo['isspecifiedhosp'];//本人定点医院状态
                // $partienResultData['Warning'] = ($partienResultData['patientType']!='北京工伤保险' && $businessType == 'ZZJF' )?substr($ybInfo['Warning'],strripos($ybInfo['Warning'],'[')):'[工伤患者就诊请去窗口办理]';//读卡警告信息   工伤患者可以缴费 工伤患者不可以进行其他业务
                //正常患者有warring的话 正常提示
                // $partienResultData['patientType'] = '北京工伤保险';
                if($partienResultData['patientType']=='北京工伤保险' )
                {
                   if($businessType != 'ZZJF')
                   {
                        $partienResultData['Warning'] =  '[工伤患者就诊请去窗口办理]';
                   }else
                   {
                        $partienResultData['Warning'] =  substr($ybInfo['Warning'],strripos($ybInfo['Warning'],'['));
                   }
                }else
                {
                    $partienResultData['Warning'] = substr($ybInfo['Warning'],strripos($ybInfo['Warning'],'['));
                }
                //工伤患者并且不是缴费业务 提示工伤去窗口处理 
                $partienResultData['ybFundtype'] = ($partienResultData['patientType']=='北京工伤保险' && $businessType != 'ZZJF')?1:0;// 1 不可以 0 可以
                $partienResultData['idNo'] = $ybInfo["id_no"];   // 身份证号
                $partienResultData['name'] = $ybInfo["personname"]; // 姓名
            }
            $partienResultData['balance'] = $jytInfo['balance'];//京医通卡余额——————————————————————新增
            $partienResultData['jytCardNo'] = $jytInfo['card_no'];//京医通卡号——————————————————————新增
            $baseData=$partienResultData;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '您已在医院建档','data' => $baseData);
            Log::write("获取患者信息内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        } else 
        {
            header('Content-Type:application/json;charset=utf8');
            if($businessType == 'ZZJK')
            {
                //建档
               if($treatCardType == '3')
               {    
                   //医保卡返回患者信息
                    $partienResultData['YbBalance'] = $ybInfo['personcount'];//个人账户余额
                    $partienResultData['persontype'] = $ybInfo['persontype'];//参保人员类别
                    $partienResultData['isinredlist'] = $ybInfo['isinredlist'];//是否在红名单
                    $partienResultData['isspecifiedhosp'] = $ybInfo['isspecifiedhosp'];//本人定点医院状态
                    $partienResultData['hosCardNo'] = $treatCardNo;
                    $partienResultData['Warning'] = $ybInfo['Warning'];//读卡警告信息
                    $partienResultData['idNo'] = $ybInfo["id_no"];   // 身份证号
                    $partienResultData['name'] = $ybInfo["personname"]; // 姓名
                    $partienResultData['isCreate']=1;
                    $partienResultData['gender']  = $ybInfo["sex"]==1?'男':'女';    // 性别
                    $partienResultData['birthday']  = $ybInfo["birthday"]; // 出生日期
                    $baseData=$partienResultData;
                    $result = array('code' => 1,'msg' => '','data' => $baseData);
               }else
               {
                   //京医通卡返回患者信息
                    $partienResultData['YbBalance'] = '';//个人账户余额
                    $partienResultData['persontype'] ='';//参保人员类别
                    $partienResultData['isinredlist'] ='';//是否在红名单
                    $partienResultData['isspecifiedhosp'] = '';//本人定点医院状态
                    $partienResultData['hosCardNo'] = $treatCardNo;
                    $partienResultData['Warning'] = $jytInfo['balance'];//读卡警告信息
                    $partienResultData['idNo'] = $jytInfo['idno'];   // 身份证号
                    $partienResultData['name'] =  $jytInfo['name']; // 姓名
                    $partienResultData['isCreate']=1;
                    $partienResultData['gender']  = $jytInfo["sex"]==1?'男':'女';    // 性别
                    $str = $jytInfo["birthday"];
                    $partienResultData['birthday']  = substr($str,0,4).'-'.substr($str,4,2).'-'.substr($str,6,2); // 出生日期
                    $baseData=$partienResultData;
                    $result = array('code' => 1,'msg' => '','data' => $baseData);
               }
            }else
            {
                //非建档
                $baseData['isCreate']=1;
                $result = array('code' => 1,'msg' => '未查到院内患者信息，请回到首页选择“建卡关联”功能进行建档关联','data' => $baseData);
            }
            Log::write("获取患者信息内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }
    /**新增  
    * 查询出诊排版返回科室
    */
    public function getDeptList($parameters = ''){
        Log::write("出诊排版列表内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $hospitalCode=$reqData['hospitalCode'];
        $startDate=$reqData['startDate'];
        $endDate=$reqData['endDate'];
        
        $devCode='rwnqzzj01';// 06883

        /* $startDate = '2020-10-31';
        $endDate= '2020-11-8'; */
        $hospitalCode ='2';

        $str = '<Request>
                    <TradeCode>1012</TradeCode>
                    <ExtOrgCode></ExtOrgCode>
                    <ClientType></ClientType>
                    <HospitalId>'.$hospitalCode.'</HospitalId>
                    <DepartmentType></DepartmentType>
                    <DepartmentCode></DepartmentCode>
                    <DepartmentGroupCode></DepartmentGroupCode>
                    <StartDate>'.$startDate.'</StartDate>
                    <EndDate>'.$endDate.'</EndDate>
                    <ExtUserID>'.$devCode.'</ExtUserID>
            </Request>'; 
        $result = $this->reqSoap($str,'QueryDepartment');
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        // print_r($rel);exit;
        if ($rel['ResultCode'] == '0') 
        {
            if ($rel['RecordCount'] <= 1 ) 
            {
                $datarow[] = $rel['Departments']['Department'];
            } else 
            {
                $datarow = $rel['Departments']['Department'];
            }
            
           /* $i=0;
            foreach ($datarow as $a => $b) 
            {
                $ptdata[$i]['deptCode'] = $b['DepartmentCode'];
                $ptdata[$i]['deptName'] = $b['DepartmentName'];
                $ptdata[$i]['childDepts'][] = array('deptCode' => $b['DepartmentCode'],'deptName' => $b['DepartmentName']);
                $i++;
            }*/
            $baseData=$datarow;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '成功','data' => $baseData);
            Log::write("获取出诊科室列表内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        } else {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => '');
            Log::write("获取出诊科室列表内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
        // echo "<pre>";
        // print_r($rel);exit;
        Log::write("出诊排版列表内部调用返回处理后的报文：" . var_export($rel, true), '', $type = '', $destination = self::$LOGS_PATH);
        return $rel;
    }
    /**OK
    * 获取出诊科室列表
    */
    public function treatDept($parameters = ''){
        Log::write("获取出诊科室列表内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $hospitalCode=$reqData['hospitalCode'];
        $startDate=$reqData['startDate'];
        $endDate=$reqData['endDate'];
        $devCode=$reqData['devCode'];
        // $hospitalCode = '3';
        $str = '<Request>
                    <TradeCode>1012</TradeCode>
                    <ExtOrgCode></ExtOrgCode>
                    <ClientType></ClientType>
                    <HospitalId>'.$hospitalCode.'</HospitalId>
                    <DepartmentType></DepartmentType>
                    <DepartmentCode></DepartmentCode>
                    <DepartmentGroupCode></DepartmentGroupCode>
                    <StartDate>'.$startDate.'</StartDate>
                    <EndDate>'.$endDate.'</EndDate>
                    <ExtUserID>'.$devCode.'</ExtUserID>
            </Request>'; 
        $result = $this->reqSoap($str,'QueryDepartment');
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        if ($rel['ResultCode'] == '0') 
        {
            if ($rel['RecordCount'] <= 1 ) 
            {
                $datarow[] = $rel['Departments']['Department'];
            } else 
            {
                $datarow = $rel['Departments']['Department'];
            }
            
            $i=0;
            foreach ($datarow as $a => $b) 
            {
                $ptdata[$i]['deptCode'] = $b['DepartmentCode'];
                $ptdata[$i]['deptName'] = $b['DepartmentName'];
                $ptdata[$i]['childDepts'][] = array('deptCode' => $b['DepartmentCode'],'deptName' => $b['DepartmentName']);
                $i++;
            }
            $baseData=$ptdata;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '成功','data' => $baseData);
            Log::write("获取出诊科室列表内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        } else {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => '');
            Log::write("获取出诊科室列表内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }
     /**OK
     *医生列表 treatDoctor
     */
    public function treatDoctor($parameters = ''){
        Log::write("获取医生列表内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $deptCode=$reqData['deptCode'];
        $hospitalCode=$reqData['hospitalCode'];
        $startDate=$reqData['startDate'];
        $endDate=$reqData['endDate'];
        $devCode=$reqData['devCode'];
        $str = '<Request>
                    <TradeCode>1004</TradeCode>
                    <ExtOrgCode></ExtOrgCode>
                    <ClientType></ClientType>
                    <HospitalId>'.$hospitalCode.'</HospitalId>
                    <ExtUserID>'.$devCode.'</ExtUserID>
                    <StartDate>'.$startDate.'</StartDate>
                    <EndDate>'.$endDate.'</EndDate>
                    <DepartmentCode>'.$deptCode.'</DepartmentCode>
                    <ServiceCode></ServiceCode>
                    <DoctorCode></DoctorCode>
                    <RBASSessionCode></RBASSessionCode>
                    <StopScheduleFlag></StopScheduleFlag>
                    <PatientID></PatientID>
                    <SessType></SessType>
            </Request>';
        $result = $this->reqSoap($str,'QueryAdmSchedule');
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        if ($rel['ResultCode'] == '0') 
        {
            if ($rel['RecordCount'] <= 1) {
                $datarow[] = $rel['Schedules']['Schedule'];
            } else {
                $datarow = $rel['Schedules']['Schedule'];
            }
            $doctdata = array();
            for ($j=0; $j < count($datarow); $j++) 
            { 
                $doctdata[$j]['deptCode'] = $datarow[$j]['DepartmentCode'];
                $doctdata[$j]['deptName'] = $datarow[$j]['DepartmentName'];
                $doctdata[$j]['doctorName'] = $datarow[$j]['DoctorName'];
                $doctdata[$j]['doctorCode'] = $datarow[$j]['DoctorCode'];
            }
            $baseData=$doctdata;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '成功','data' => $baseData);
            Log::write("获取医生列表内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        } else 
        {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => '');
            Log::write("获取医生列表内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }
    /**专家出诊表
     *查询出诊信息  getScheduleList
     */
    public function getScheduleList($parameters = '')
    {
        Log::write("获取出诊信息列表内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $hospitalCode=$reqData['hospitalCode'];
        $startDate=$reqData['startDate'];
        $endDate=$reqData['endDate'];
        $deptCode=$reqData['deptCode'];
        $devCode=$reqData['devCode'];
        // $deptCode = '47';
        // $startDate = '2020-10-31';
        // $endDate= '2020-11-8';
        // $hospitalCode ='3';
        $devCode='rwnqzzj01';
        $str = '<Request>
                <TradeCode>1004</TradeCode>
                <ExtOrgCode></ExtOrgCode>
                <ClientType></ClientType>
                <HospitalId>'.$hospitalCode.'</HospitalId>
                <ExtUserID>'.$devCode.'</ExtUserID>
                <StartDate>'.$startDate.'</StartDate>
                <EndDate>'.$endDate.'</EndDate>
                <DepartmentCode>'.$deptCode.'</DepartmentCode>
                <ServiceCode></ServiceCode>
                <DoctorCode></DoctorCode>
                <RBASSessionCode></RBASSessionCode>
                <StopScheduleFlag></StopScheduleFlag>
                <PatientID></PatientID>
                <SessType></SessType>
            </Request>';
        $result = $this->reqSoap($str,'QueryAdmSchedule');
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        if ($rel['ResultCode'] == '0'){
                if ($rel['RecordCount'] <= 1) {
                    $datarow[] = $rel['Schedules']['Schedule'];
                } else {
                    $datarow = $rel['Schedules']['Schedule'];
                }
                
                $baseData=$datarow;
                header('Content-Type:application/json;charset=utf8');
                $result = array('code' => 0,'msg' => '成功','data' => $baseData);
                Log::write("获取出诊信息列表内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            } else {
                header('Content-Type:application/json;charset=utf8');
                $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => '');
                Log::write("获取出诊信息列表内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            }
    }
    /**OK   字段 ticketType 有疑问
     *号源信息  tickets
     */
    public function tickets($parameters = ''){
        Log::write("获取列表内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $deptCode=$reqData['deptCode'];
        $hospitalCode=$reqData['hospitalCode'];
        $startDate=$reqData['startDate'];
        $endDate=$reqData['endDate'];
         /* 
            2020年11月6日13:01:31
            sgy
            只查当天的号
        */
        $endDate = date("Y-m-d",time());//只查当天的号  
        $devCode=$reqData['devCode'];
        $regFlag=$reqData['regFlag'];//，1-挂号 2-预约  
        $flag = $reqData['flag'];//预约日历标识 1日志  其他的数字 正常的号源
        $weekarray=array("日","一","二","三","四","五","六");
        if ($regFlag==1) {
            $str = '<Request>
                    <TradeCode>1004</TradeCode>
                    <ExtOrgCode></ExtOrgCode>
                    <ClientType></ClientType>
                    <HospitalId>'.$hospitalCode.'</HospitalId>
                    <ExtUserID>'.$devCode.'</ExtUserID>
                    <StartDate>'.$startDate.'</StartDate>
                    <EndDate>'.$endDate.'</EndDate>
                    <DepartmentCode>'.$deptCode.'</DepartmentCode>
                    <ServiceCode></ServiceCode>
                    <DoctorCode></DoctorCode>
                    <RBASSessionCode></RBASSessionCode>
                    <StopScheduleFlag></StopScheduleFlag>
                    <PatientID></PatientID>
                    <SessType></SessType>
            </Request>';
            $result = $this->reqSoap($str,'QueryAdmSchedule');
            $OB_OutXml = simplexml_load_string($result);
            $rel = json_decode(json_encode($OB_OutXml),true);
            if ($rel['ResultCode'] == '0'){
                if ($rel['RecordCount'] <= 1) {
                    $datarow[] = $rel['Schedules']['Schedule'];
                } else {
                    $datarow = $rel['Schedules']['Schedule'];
                }
                $doctdata = array();
                for ($j=0; $j < count($datarow); $j++) {
                    // 当日四点之后不返回后台号源
                    if(date("H",time()) >= 16 && $datarow[$j]['ServiceDate'] == date('Y-m-d',time()))
                    {
                        continue;
                    } 
                    if($datarow[$j]['SessionName'] == '上午'){
                        $period = '1';
                    }else if($datarow[$j]['SessionName'] == '下午'){
                       $period = '2'; 
                    }else{
                        $period = '3'; 
                    }
                    /* 
                        上午好
                    */
                    $doctdata[$j]['deptCode'] = $datarow[$j]['DepartmentCode'];
                    $doctdata[$j]['deptName'] = $datarow[$j]['DepartmentName'];
                    $doctdata[$j]['doctorName'] = empty($datarow[$j]['CTPcpDesc'])?$datarow[$j]['DoctorTitle']:$datarow[$j]['CTPcpDesc'];//2020年10月19日18:34:30  按医院要求显示医生外部名称
                    $doctdata[$j]['doctorCode'] = $datarow[$j]['DoctorCode'];
                    $doctdata[$j]['scheduleNo'] = $datarow[$j]['ScheduleItemCode'];
                    $doctdata[$j]['scheduleDate'] = $datarow[$j]['ServiceDate'];
                    $doctdata[$j]['period'] = $period;
                    $doctdata[$j]['ticketType'] = $datarow[$j]['DoctorTitle'];
                    $doctdata[$j]['ticketTypeName'] = $datarow[$j]['DoctorSessType'];
                    $doctdata[$j]['fee'] = bcmul($datarow[$j]['RegFee'],100);
                    /*
                        如果是上午号；直接显示约满
                        2020年11月6日13:02:03
                        sgy
                    */
                    if($doctdata[$j]['period'] == '1')
                    {
                        $doctdata[$j]['left'] = 0;
                    }else
                    {
                        $doctdata[$j]['left'] = $datarow[$j]['AvailableLeftNum'];
                    }
                    $doctdata[$j]['total'] = $datarow[$j]['AvailableTotalNum'];
                    $doctdata[$j]['weekNow'] =  '周'.$weekarray[$datarow[$j]['WeekDay']];
                    $doctdata[$j]['flag'] = 1;
                    $doctdata[$j]['timeArr']= '';
                    
                }
                $baseData=$doctdata;
                header('Content-Type:application/json;charset=utf8');
                $result = array('code' => 0,'msg' => '成功','data' => $baseData);
                Log::write("获取号源列表内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            } else {
                header('Content-Type:application/json;charset=utf8');
                $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => '');
                Log::write("获取号源列表内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            }
        } else {
          /*   $doctdata = ''
            $baseData=$doctdata;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '成功','data' => $baseData);
            Log::write("获取号源列表内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result; */
            if ($flag==0) 
            {
                $str = '<Request>
                    <TradeCode>1004</TradeCode>
                    <ExtOrgCode></ExtOrgCode>
                    <ClientType></ClientType>
                    <HospitalId>'.$hospitalCode.'</HospitalId>
                    <ExtUserID>'.$devCode.'</ExtUserID>
                    <StartDate>'.$startDate.'</StartDate>
                    <EndDate>'.$endDate.'</EndDate>
                    <DepartmentCode>'.$deptCode.'</DepartmentCode>
                    <ServiceCode></ServiceCode>
                    <DoctorCode></DoctorCode>
                    <RBASSessionCode></RBASSessionCode>
                    <StopScheduleFlag></StopScheduleFlag>
                    <PatientID></PatientID>
                    <SessType></SessType>
                </Request>';
                $result = $this->reqSoap($str,'QueryAdmSchedule');
                $OB_OutXml = simplexml_load_string($result);
                $rel = json_decode(json_encode($OB_OutXml),true);
                if ($rel['ResultCode'] == '0'){
                    if ($rel['RecordCount'] <= 1) {
                        $datarow[] = $rel['Schedules']['Schedule'];
                    } else {
                        $datarow = $rel['Schedules']['Schedule'];
                    }
                    $doctdata = array();
                    for ($j=0; $j < count($datarow); $j++) { 
                        if($datarow[$j]['SessionName'] == '上午'){
                            $period = '1';
                        }else if($datarow[$j]['SessionName'] == '下午'){
                           $period = '2'; 
                        }else{
                            $period = '3'; 
                        }
                        $doctdata[$j]['deptCode'] = $datarow[$j]['DepartmentCode'];
                        $doctdata[$j]['deptName'] = $datarow[$j]['DepartmentName'];
                        $doctdata[$j]['doctorName'] = empty($datarow[$j]['CTPcpDesc'])?$datarow[$j]['DoctorTitle']:$datarow[$j]['CTPcpDesc'];
                        $doctdata[$j]['doctorCode'] = $datarow[$j]['DoctorCode'];
                        $doctdata[$j]['scheduleNo'] = $datarow[$j]['ScheduleItemCode'];
                        $doctdata[$j]['scheduleDate'] = $datarow[$j]['ServiceDate'];
                        $doctdata[$j]['period'] = $period;
                        $doctdata[$j]['ticketType'] = $datarow[$j]['DoctorTitle'];
                        $doctdata[$j]['ticketTypeName'] = $datarow[$j]['DoctorSessType'];
                        $doctdata[$j]['fee'] = bcmul($datarow[$j]['RegFee'],100);
                        $doctdata[$j]['left'] = $datarow[$j]['AvailableLeftNum'];
                        $doctdata[$j]['total'] = $datarow[$j]['AvailableTotalNum'];
                        $doctdata[$j]['flag'] = 1;
                        $doctdata[$j]['timeArr']= '';
                        $doctdata[$j]['weekNow'] =  '周'.$weekarray[$datarow[$j]['WeekDay']];
                    }
                    $baseData=$doctdata;
                    header('Content-Type:application/json;charset=utf8');
                    $result = array('code' => 0,'msg' => '成功','data' => $baseData);
                    Log::write("获取号源列表内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                    return $result;
                } else {
                    header('Content-Type:application/json;charset=utf8');
                    $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => '');
                    Log::write("获取号源列表内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                    return $result;
                }
            } else {
                $str = '<Request>
                            <TradeCode>1004</TradeCode>
                            <ExtOrgCode></ExtOrgCode>
                            <ClientType></ClientType>
                            <HospitalId>'.$hospitalCode.'</HospitalId>
                            <ExtUserID>'.$devCode.'</ExtUserID>
                            <StartDate>'.$startDate.'</StartDate>
                            <EndDate>'.$endDate.'</EndDate>
                            <DepartmentCode>'.$deptCode.'</DepartmentCode>
                            <ServiceCode></ServiceCode>
                            <DoctorCode></DoctorCode>
                            <RBASSessionCode></RBASSessionCode>
                            <StopScheduleFlag></StopScheduleFlag>
                            <PatientID></PatientID>
                            <SessType></SessType>
                    </Request>';
                $result = $this->reqSoap($str,'QueryAdmSchedule');
                $OB_OutXml = simplexml_load_string($result);
                $rel = json_decode(json_encode($OB_OutXml),true);
                if ($rel['ResultCode'] == '0' && $rel['ResultContent'] == ''){
                    if ($rel['RecordCount'] <= 1) {
                        $datarow[] = $rel['Schedules']['Schedule'];
                    } else {
                        $datarow = $rel['Schedules']['Schedule'];
                    }
                    foreach($datarow as $key=>$val)
                    {
                         // 当日四点之后不返回后台号源
                        if(date("H",time()) >= 16 && $datarow[$key]['ServiceDate'] == date('Y-m-d',time()))
                        {
                            $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => array());
                            unset($datarow[$key]);
                            continue;
                        } 
                        if(is_array($val['AvailableLeftNum']))
                        {
                            unset($datarow[$key]);
                        }
                        $datarow[$key]['weekNow'] =  '周'.$weekarray[$val['WeekDay']];
                    }
                    $doctdata = array();
                    $datarow=$this->dataGroup($datarow,'ServiceDate');
                    $i=0;
                    foreach ($datarow as $key => $v) 
                    {
                        $doctdata[$i]['scheduleDate']=$key;
                        $doctdata[$i]['left'] = count($v);
                        $doctdata[$i]['flag'] = 1;
                        $i++;
                    }
                    $baseData=$doctdata;
                    header('Content-Type:application/json;charset=utf8');
                    $result = array('code' => 0,'msg' => '成功','data' => $baseData);
                    Log::write("获取号源列表内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                    return $result;
                }else
                {
                    header('Content-Type:application/json;charset=utf8');
                    $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => array());
                    Log::write("获取号源列表内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                    return $result;
                }
            }
        }
    }
    /**OK   
     *锁号  regLock
     */
    public function regLock($parameters = ''){
        Log::write("获取锁号列表内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $patientId=$reqData['patientId'];
        $cardType=$reqData['treatCardType'];
        $CardNo=$reqData['treatCardNo'];
        $scheduleNo=$reqData['scheduleNo'];
        $devCode=$reqData['devCode'];
        $hospitalCode=$reqData['hospitalCode'];
        $divResult=$reqData['divResult'];
        $businessType = $reqData['businessType'];//取号 QH
        $isPay=$reqData['isPay'];//是否支付   isPay    1 收费  2 不收费
        $isRW = $reqData['isRW'];//是不是融威  1 是  2 不是
        $serviceFee = $reqData['serviceFee'];//医事服务费
        
        $date = date("Y-m-d",time());
        $time = date("H:i:s",time());
        switch ($cardType) {
            case '01'://yb
                $cardType='3';
                break;
            case '03'://jzk
                $cardType='2';
                break;
            case '04'://jyt
                $cardType='4';
                break;
        }
        //解析医保返回----预约挂号不需要锁号
        if($cardType == '3') 
        {
            if (substr($divResult,0,1) == '0') 
            {
                $ybInfo=$this->jieXi($divResult,'YYT_YB_GH_CALC');
                $ybInfo['cash']=$ybInfo['cash']=='0.00'?0:$ybInfo['cash'];
            } else 
            {
                header('Content-Type:application/json;charset=utf8');
                $result = array('code' => 1,'msg' => '医保划价失败','data' => '');
                Log::write("锁号内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            }
        }
        // if($cardType == '3') 
        // {
        //     if (substr($divResult,0,1) == '0') 
        //     {
        //         $ybInfo=$this->jieXi($divResult,'YYT_YB_GH_CALC');
        //         $ybInfo['cash']=$ybInfo['cash']=='0.00'?0:$ybInfo['cash'];
        //     } else 
        //     {
        //         header('Content-Type:application/json;charset=utf8');
        //         $result = array('code' => 1,'msg' => '医保划价失败','data' => '');
        //         Log::write("锁号内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
        //         return $result;
        //     }
        // }
        //取号不需要进行锁号
        if($businessType == 'QH' && $cardType == '3')
        {
            if($isPay == '1')
            {
                //收费
                $lockInfo['cash'] = bcmul($ybInfo['cash'],100);
            }else
            {
                //不收费
                $lockInfo['cash'] = 0;
            }
            $lockInfo['insurFee'] = bcmul($ybInfo['fund'],100);
            $lockInfo['insurTradeNo'] = $ybInfo['InsuAdmDr'];
            $lockInfo['insurAccountPay'] = bcmul($ybInfo['personcountpay'],100);
            $baseData=$lockInfo;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '成功','data' => $baseData);
            Log::write("医保取号内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }else if($businessType == 'QH' && $cardType == '4')
        {
            if($isPay == '1')
            {
                //收费
                $lockInfo['cash'] = bcmul($serviceFee,100);
                $lockInfo['chargeTotal'] = bcmul($serviceFee,100);
            }else
            {
                //不收费
                $lockInfo['cash'] = 0;
            }
            $baseData=$lockInfo;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '成功','data' => $baseData);
            Log::write("自费取号内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
        else
        {
            $str = '<Request>
                    <TradeCode>10015</TradeCode>
                    <ClientType></ClientType>
                    <HospitalID>'.$hospitalCode.'</HospitalID>
                    <TradeDate>'.$date.'</TradeDate>
                    <TradeTime>'.$time.'</TradeTime>
                    <ExtUserID>'.$devCode.'</ExtUserID>
                    <ScheduleItemCode>'.$scheduleNo.'</ScheduleItemCode>
                    <AdmDoc></AdmDoc>
                    <PatientID>'.$patientId.'</PatientID>
                    <CardNo>'.$CardNo.'</CardNo>
                    <CardType>'.$cardType.'</CardType>
                    <CredTypeCode></CredTypeCode>
                    <IDCardNo></IDCardNo>
                    <TransactionId></TransactionId>
                    <OldTransactionId></OldTransactionId>
                    <Mobile></Mobile>
                    <LockQueueNo></LockQueueNo>
                    <PayOrdId></PayOrdId>
            </Request>';
            $result = $this->reqSoap($str,'LockOrder');
            $result = strstr($result, "<Response>");
            $OB_OutXml = simplexml_load_string($result);
            $rel = json_decode(json_encode($OB_OutXml),true);
            // 执行成功
            if ($rel['ResultCode'] == '0') {
                $lockInfo['regNo'] = $scheduleNo;
                $lockInfo['receiptNo'] = $rel['TransactionId'];
                $lockInfo['chargeTotal'] = bcmul($rel['RegFee'],100);
                $lockInfo['cash'] = $cardType == '3'?bcmul($ybInfo['cash'],100):bcmul($rel['RegFee'],100);
                $lockInfo['insurFee'] = $cardType == '3'?bcmul($ybInfo['fund'],100):0;
                $lockInfo['insurTradeNo'] = $cardType == '3'?$ybInfo['InsuAdmDr']:0;
                $lockInfo['insurAccountPay'] = $cardType == '3'?bcmul($ybInfo['personcountpay'],100):0;
                $lockInfo['visitTime'] = $rel['AdmDate'];
                $lockInfo['regNo'] = $rel['LockQueueNo'];
                // $lockInfo['extData'] = json_encode($rel['ExpString']);
                $baseData=$lockInfo;
                header('Content-Type:application/json;charset=utf8');
                $result = array('code' => 0,'msg' => '成功','data' => $baseData);
                Log::write("（挂号）锁号内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            } else {
                header('Content-Type:application/json;charset=utf8');
                $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => '');
                Log::write("锁号内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            }  
        }
        
    }

    /**OK
    *取消锁号
    *
    */
    public function regUnLock($parameters = ''){
        Log::write("获取解锁号源内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $hospitalCode=$reqData['hospitalCode'];
        $devCode=$reqData['devCode'];
        $regNo=$reqData['regNo'];
        $scheduleNo=$reqData['scheduleNo'];
        $receiptNo=$reqData['receiptNo'];
        $str = '<Request>
                <TradeCode>10016</TradeCode>
                <ClientType></ClientType>
                <HospitalID>'.$hospitalCode.'</HospitalID>
                <ExtUserID>'.$devCode.'</ExtUserID>
                <ScheduleItemCode>'.$scheduleNo.'</ScheduleItemCode>
                <TransactionId>'.$receiptNo.'</TransactionId>
                <LockQueueNo>'.$regNo.'</LockQueueNo>
        </Request>';
        $result = $this->reqSoap($str,'UnLockOrder');
        $result = strstr($result, "<Response>");
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        // 执行成功
        if ($rel['ResultCode'] == '0') 
        {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '成功');
            Log::write("解锁号源内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        } else {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => '失败','data' => '');
            Log::write("解锁号源内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }
    /**OK 
    * 挂号支付确认
    * 
    */
    public function regConfirm($parameters = ''){
        Log::write("获取挂号保存列表内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $scheduleNo=$reqData['scheduleNo'];
        $devCode=$reqData['devCode'];
        $cardType=$reqData['treatCardType'];
        $CardNo=$reqData['treatCardNo'];
        $patientId=$reqData['patientId'];
        $payCardNo=$reqData['payCardNo'];
        $transactionId=$reqData['receiptNo'];//需前端传患者就诊类型
        $cash=$reqData['cash'];
        $payType=$reqData['payType'];
        $tradeNo=$reqData['tradeNo'];
        $outTradeNo=$reqData['outTradeNo'];
        $chargeTotal=$reqData['chargeTotal'];
        $payInsuFeeStr=$reqData['hisResult'];
        $queueNo=$reqData['regNo'];
        $businessType=$reqData['businessType'];
        $hospitalCode = $reqData['hospitalCode'];
        $resultStr = $reqData['resultStr'];//银联交易串
        $date=date("Y-m-d",time());
        $time=date("H:i:s",time());        
        switch ($cardType) {
            case '01'://yb
                $cardType='3';
                break;
            case '03'://jzk
                $cardType='2';
                break;
            case '04'://jyt
                $cardType='4';
                break;
        }   
        //支付方式
        // MISSCAN	自助机POS通
        // MISPOS	自助机银行卡
        // 1 微信支付 2支付宝 3-银联 4-京医通余额  我方
        switch ($payType) 
        {
            case '1':
                $payType='MISSCAN';
                break;
            case '2':
                $payType='MISSCAN';
                break;
            case '3':
                $payType='MISPOS';
                break;
            case '4':
                $payType='ZZJJYT';
                break;
            case '9':
                $payType='QT';
                break;
        }
        // 'resultStr' => '00,交易成功                                ,621226*********4549 ,000000001000,283333,000002,1102,193956,193956166863,898110280621144,77530404,202',
        //如果是京医通余额和医保卡余额不需要传输交易信息  sgy
        if($payType == 'MISSCAN' || $payType == 'MISPOS' )
        {
            if($payType == 'MISSCAN')
            {
                 //取B扫C的参数 relData
                $transactionTime=$reqData['relData']['transactionTime'];//交易时间
                $transactionDate=$reqData['relData']['transactionDate'];//交易日期
                $retrievalRefNum=$reqData['relData']['retrievalRefNum'];//检索参考号
                $transactionAmount=str_pad($reqData['relData']['transactionAmount'],12,"0",STR_PAD_LEFT);//交易金额
            }else
            {
                 //取银行卡的参数 
                $resultStrArr = explode(',',$resultStr);
                $transactionTime=$resultStrArr[7];//交易时间
                $transactionDate=$resultStrArr[6];//交易日期
                $retrievalRefNum=$resultStrArr[8];;//检索参考号
                $transactionAmount=$resultStrArr[3];;//交易金额
            }
            // old 32位空格+6位金额+69位空格+4位交易日期+6位交易时间+12位交易参考号  
            //新规则在 1000 处查看
            $POSPayStr = '00                              '.$transactionAmount.'                                                                     '.$transactionDate.$transactionTime.$retrievalRefNum.'                                                                                                                                                                                                                                                                                                                                                                                          ';
        }else
        {
            $POSPayStr = '';
        }
        if($cardType == '3'){
            if (substr($payInsuFeeStr,0,1) == '0') {
                $ybInfo=$this->jieXi($payInsuFeeStr,'YYT_YB_GH_SAVE');
            } else {
                header('Content-Type:application/json;charset=utf8');
                $datarow['isCanRefund']='0';
                $baseData=$datarow;
                $result = array('code' => 1,'msg' => '失败','data' => $baseData);
                Log::write("获取挂号保存内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            }
        }
        //印证这个问题？挂号和取号时 是不是可以同时传ScheduleItemCode和AppOrderCode
        if($businessType  == 'YYQH')
        {
            $AppOrderCode = $scheduleNo;
        }else
        {
            $AppOrderCode = '';
        }
        $str = '<Request>
                    <TradeCode>1101</TradeCode>
                    <TransactionId>'.$transactionId.'</TransactionId>
                    <ExtOrgCode></ExtOrgCode>
                    <ClientType></ClientType>
                    <HospitalId>'.$hospitalCode.'</HospitalId>
                    <TerminalID></TerminalID>
                    <ScheduleItemCode>'.$scheduleNo.'</ScheduleItemCode>
                    <AppOrderCode>'.$AppOrderCode.'</AppOrderCode>
                    <ExtUserID>'.$devCode.'</ExtUserID>
                    <PatientCard>'.$CardNo.'</PatientCard>
                    <CardType>'.$cardType.'</CardType>
                    <PatientID>'.$patientId.'</PatientID>
                    <PayBankCode></PayBankCode>
                    <PayCardNo>'.$payCardNo.'</PayCardNo>
                    <PayModeCode>'.$payType.'</PayModeCode>
                    <PayFee>'.$chargeTotal.'</PayFee>
                    <PayInsuFeeStr>'.$ybInfo['hisSavePar'].'</PayInsuFeeStr>
                    <PayTradeNo>'.$tradeNo.'</PayTradeNo>
                    <QueueNo>'.$queueNo.'</QueueNo>
                    <PayDetails>
                        <PayModeCode>'.$payType.'</PayModeCode>
                        <TradeChannel>RWZB</TradeChannel>
                        <PayAccountNo></PayAccountNo>
                        <PayAmt>'.$cash.'</PayAmt>
                        <PlatformNo>'.$tradeNo.'</PlatformNo>
                        <OutPayNo>'.$outTradeNo.'</OutPayNo>
                        <PayChannel></PayChannel>
                        <POSPayStr>'.$POSPayStr.'</POSPayStr>
                        <PayDate>'.$date.'</PayDate>
                        <PayTime>'.$time.'</PayTime>
                    </PayDetails>
            </Request>';
    
        $result = $this->reqSoap($str,'OPRegister');
        //$result = '<Response><ResultCode>0</ResultCode><ResultContent>挂号成功</ResultContent><SeqCode>加11</SeqCode><RegFee>50</RegFee><AdmNo>15032836</AdmNo><DeptName>眼科综合门诊(南区)</DeptName><DoctorName>眼科普通号3</DoctorName><DoctorLevelDesc>普通号</DoctorLevelDesc><TimeRange>下午</TimeRange><RegistrationID>14114447</RegistrationID><HisTradeOrderId>20201106183740BJTR3460</HisTradeOrderId></Response>';
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        // 执行成功
        if ($rel['ResultCode'] == '0') 
        {
            $return_data = array();
            $return_data['receiptNo']=$rel['TransactionId'];
            $return_data['chargeTotal']=$rel['RegFee'];
            $return_data['cash']= $cardType=='3'?'':$rel['RegFee'];
            $return_data['visitSeq']=$rel['SeqCode'];
            $return_data['visitTime']=$rel['AdmitRange'];
            $return_data['visitDate']=$date;//新增就诊日期
            $return_data['visitAddr']=$rel['AdmitAddress'];//新增就诊地点
            $return_data['deptName']=$rel['DeptName'];
            $return_data['doctName']=$rel['DoctorName'];
            $return_data['reqType']=$rel['DoctorLevelDesc'];
            $return_data['insurPersonCount']= $cardType=='3'?bcmul($ybInfo['personcountpay'],100):0;
            if($rel['TimeRange'] == '上午')
            {
                $period = '1';
            }else if($rel['TimeRange'] == '下午')
            {
               $period = '2'; 
            }else
            {
                $period = '3'; 
            }
            $return_data['period']=$period;
            $baseData=$return_data;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '成功','data' => $baseData);
            Log::write("获取挂号保存内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        } else {
            header('Content-Type:application/json;charset=utf8');
            $datarow['isCanRefund']='0';
            $baseData=$datarow;
            $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => $baseData);
            Log::write("获取挂号保存内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }
    
    /** OK
     * 查询患者已预约号信息
     */
    public function appointQuery($parameters = ''){
        Log::write("获取取号列表内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $hospitalCode=$reqData['hospitalCode'];
        $devCode=$reqData['devCode'];
        $cardType=$reqData['treatCardType'];
        $CardNo=$reqData['treatCardNo'];
        $patientId=$reqData['patientId'];
        $startDate=$reqData['startDate'];
        $endDate=$reqData['endDate'];
        $regStatusFlag=$reqData['regStatusFlag'];
        $businessType=$reqData['businessType'];
        switch ($cardType) {
            case '01'://yb
                $cardType='3';
                break;
            case '03'://jzk
                $cardType='2';
                break;
            case '04'://jyt
                $cardType='4';
                break;
        }  
        /* 
        QueryDateFlag
        查询类别 AdmDate 查询预约就诊日期
                AppDate 就是按预约操作的日期查
        */
        $str =  '<Request>
                    <TradeCode>1005</TradeCode>
                    <ExtOrgCode></ExtOrgCode>
                    <ClientType></ClientType>
                    <HospitalId>'.$hospitalCode.'</HospitalId>
                    <ExtUserID>'.$devCode.'</ExtUserID>
                    <CardNo>'.$CardNo.'</CardNo>
                    <CardType>'.$cardType.'</CardType>
                    <CredTypeCode></CredTypeCode>
                    <IDCardNo></IDCardNo>
                    <PatientNo>'.$patientId.'</PatientNo>
                    <OrderApptStartDate>'.$startDate.'</OrderApptStartDate>
                    <OrderApptEndDate>'.$endDate.'</OrderApptEndDate>
                    <QueryDateFlag>AdmDate</QueryDateFlag>
                    <QueryUserType></QueryUserType>
                    <OrderStatus>normal</OrderStatus>
                    <OrderCode></OrderCode>
                </Request>';

        $result = $this->reqSoap($str,'QueryOrder');
        $result = strstr($result, "<Response>");
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        // 执行成功
        // if ($rel['ResultCode'] == '0' && $rel_s['ResultCode'] == '0')
        if ($rel['ResultCode'] == '0' )
        {
            if ($rel['RecordCount'] <= 1) 
            {
                $drow[]=$rel['Orders']['Order'];
            }else
            {
                $drow = $rel['Orders']['Order'];
            }

            // if ($rel_s['RecordCount'] <= 1)
            // {
            //     $drow_s[]=$rel_s['Orders']['Order'];
            // }else
            // {
            //     $drow_s = $rel_s['Orders']['Order'];
            // }

            $datarow_attr_ary = array();
            for ($i = 0; $i < $rel['RecordCount']; $i++) 
            {
                 // 当日四点之后不返回后台号源
                if(date("H",time()) >= 16)
                {
                    continue;
                } 
                $atrow  = array();
                $atrow = (array)$drow[$i];
                $datarow_attr_ary[$i]['patientId'] = $atrow['PatientNo'];
                $datarow_attr_ary[$i]['regNo'] = $atrow['OrderCode']; //预约标识
                $datarow_attr_ary[$i]['regDate'] = $atrow['AdmitDate'];
                $datarow_attr_ary[$i]['deptCode'] = '';//科室编码
                $datarow_attr_ary[$i]['deptName'] = $atrow['Department'];//科室名称
                $datarow_attr_ary[$i]['doctorName'] = $atrow['Doctor'];
                $datarow_attr_ary[$i]['doctorTitle'] = $atrow['DoctorTitle'];//医生职称
                 //WIN	窗口预约
                //114	电话预约
                // DOC	诊间预约
                // DOCADD	诊间加号
                // WEB	网络预约
                // CYFZ	住院复诊预约
                // WX	微信预约
                // JYTY	京医通预约
                // KKZZ	转诊预约
                // JYTZ	京医通转诊预约
                // TRAN	京医通先预约后缴费
                // RWZB	荣威众邦自助机
                switch($atrow['AppSource'])
                {
                    case "WIN":
                        $regChannel = '窗口预约';
                        $datarow_attr_ary[$i]['isPay'] = '1';
                        $datarow_attr_ary[$i]['isRW'] = '2';
                    break;
                    case "114":
                        $regChannel = '电话预约';
                        $datarow_attr_ary[$i]['isPay'] = '1';
                        $datarow_attr_ary[$i]['isRW'] = '2';
                    break;
                    case "DOC":
                        $regChannel = '诊间预约';
                        $datarow_attr_ary[$i]['isPay'] = '1';
                        $datarow_attr_ary[$i]['isRW'] = '2';
                    break;
                    case "DOCADD":
                        $regChannel = '诊间加号';
                        $datarow_attr_ary[$i]['isPay'] = '1';
                        $datarow_attr_ary[$i]['isRW'] = '2';
                    break;
                    case "WEB":
                        $regChannel = '网络预约';
                        $datarow_attr_ary[$i]['isPay'] = '1';
                        $datarow_attr_ary[$i]['isRW'] = '2';
                    break;
                    case "CYFZ":
                        $regChannel = '住院复诊预约';
                        $datarow_attr_ary[$i]['isPay'] = '1';
                        $datarow_attr_ary[$i]['isRW'] = '2';
                    break;
                    case "WX":
                        $regChannel = '微信预约';
                        $datarow_attr_ary[$i]['isPay'] = '1';
                        $datarow_attr_ary[$i]['isRW'] = '2';
                    break;
                    case "JYTY":
                        $regChannel = '京医通预约';
                        $datarow_attr_ary[$i]['isPay'] = '2';
                        $datarow_attr_ary[$i]['isRW'] = '2';
                    break;
                    case "TRAN":
                        $regChannel = '京医通先预约后缴费';
                        $datarow_attr_ary[$i]['isPay'] = '1';
                        $datarow_attr_ary[$i]['isRW'] = '2';
                    break;
                    case "RWZB":
                        $regChannel = '融威众邦自助机';
                        $datarow_attr_ary[$i]['isPay'] = '2';
                        $datarow_attr_ary[$i]['isRW'] = '1';
                    break;
                    case "JYTZ":
                        $regChannel = '京医通转诊预约';
                        $datarow_attr_ary[$i]['isPay'] = '2';
                        $datarow_attr_ary[$i]['isRW'] = '2';
                    break;
                }
               /*
                医保卡取号时对自费的科室进行处理；
                2020年12月14日18:22:14
                邵冠亚
                */
                if($cardType == '3' && in_array($atrow['Department'],C("UNYBROOM")))
                {
                    //isTakeNoCode
                    //isTakeNoMsg 
                    $datarow_attr_ary[$i]['isTakeNoCode'] = 1;//不可以医保卡取号
                    $datarow_attr_ary[$i]['isTakeNoMsg'] = '该科室为自费号，请使用京医通卡进行取号。';//不可以取号的原因
                }else
                {
                    $datarow_attr_ary[$i]['isTakeNoCode'] = 0;//不可以医保卡取号
                    $datarow_attr_ary[$i]['isTakeNoMsg'] = '';//不可以取号的原因
                }
                $datarow_attr_ary[$i]['regChannel'] = $regChannel;//挂号渠道
                $datarow_attr_ary[$i]['regStatusFlag'] = '13';//预约状态标识
                $datarow_attr_ary[$i]['tradeNo'] = $atrow['PayTradeNo'];//预约时的订单信息
                if($atrow['SessionName'] == '上午')
                {
                    $period = '1';
                    if (date('H')>=11) {
		                $datarow_attr_ary[$i]['regStatusFlag'] = '4';//预约状态标识
                    }
                }else if($atrow['SessionName'] == '下午')
                {
                   $period = '2'; 
                }else
                {
                    $period = '3'; 
                }
                $datarow_attr_ary[$i]['period'] = $period;
                $datarow_attr_ary[$i]['regIndex'] = $atrow['SeqCode'];
                $datarow_attr_ary[$i]['fee'] = $atrow['RegFee'];
            }
            // $datarow_ary = array();
            // for ($i = 0; $i < $rel_s['RecordCount']; $i++) 
            // {
            //     $atrow = (array)$drow_s[$i];
            //     $datarow_ary[$i]['patientId'] = $atrow['PatientID'];
            //     $datarow_ary[$i]['regNo'] = $atrow['AdmNo']; //预约标识
            //     $datarow_ary[$i]['regDate'] = $atrow['AdmitDate'];
            //     $datarow_ary[$i]['deptCode'] = $atrow['DepartmentCode'];//科室编码
            //     $datarow_ary[$i]['deptName'] = $atrow['Department'];//科室名称
            //     $datarow_ary[$i]['doctorName'] = $atrow['Doctor'];
            //     $datarow_ary[$i]['doctorTitle'] = $atrow['DoctorTitle'];//医生职称
            //     $datarow_ary[$i]['regChannel'] = '';//挂号渠道
            //     $datarow_ary[$i]['regStatusFlag'] = '1';//预约状态标识
            //     if($atrow['SessionName'] == '上午')
            //     {
            //         $period = '1';
            //     }else if($atrow['SessionName'] == '下午')
            //     {
            //        $period = '2'; 
            //     }else
            //     {
            //         $period = '3'; 
            //     }
            //     $datarow_ary[$i]['period'] = $period;
            //     $datarow_ary[$i]['regIndex'] = $atrow['SeqCode'];
            //     $datarow_ary[$i]['fee'] = $atrow['RegFee'];
            // }
            // $baseData=array_merge($datarow_attr_ary,$datarow_ary);
            $baseData=$datarow_attr_ary;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '成功','data' => $baseData);
            Log::write("获取预约挂号列表内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        } else 
        {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => '');
            Log::write("获取预约挂号列表内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }

    /**OK
    *取消预约
    *
    */
    public function appointCancel($parameters = ''){
        Log::write("获取取消预约内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $hospitalCode=$reqData['hospitalCode'];
        $devCode=$reqData['devCode'];
        $regNo=$reqData['regNo'];
        $tradeNo=$reqData['tradeNo'];
        $cash=$reqData['cash'];
        $time=$reqData['time'] ? $reqData['time'] : '';
        $date=$reqData['date'] ? $reqData['date']  : '';
        $payStr =$reqData['payStr'];
        $payStrArr = json_decode($payStr,true);
        $transactionTime=$payStrArr['transactionTime'];//交易时间
        $transactionDate=$payStrArr['transactionDate'];//交易日期
        $retrievalRefNum=$payStrArr['retrievalRefNum'];//检索参考号
        $transactionAmount=str_pad($payStrArr['transactionAmount'],12,"0",STR_PAD_LEFT);//交易金额
        $regChannel = $reqData['regChannel'];//预约渠道回传给HIS
        switch($regChannel)
        {
            case "电话预约": 
                $regChannel = 'WIN';
            break;
            case "诊间预约": 
                $regChannel = 'DOC';
            break;
            case "诊间加号":
                $regChannel = 'DOCADD';
            break;
            case "网络预约":
                $regChannel = 'WEB';
            break;
            case "住院复诊预约":
                $regChannel = 'CYFZ';
            break;
            case "微信预约":
                $regChannel = 'WX';
            break;
            case "京医通预约":
                $regChannel = 'JYTY';
            break;
            case "京医通先预约后缴费":
                $regChannel = 'TRAN';
            break;
            case "融威众邦自助机":
                $regChannel = 'RWZB';
            break;
            case "京医通转诊预约":
                $regChannel = 'JYTZ';
            break;
        }
        // 00				0-2 交易结果描述
        // WXZF				3-6收单行(发卡行代码)
        // 134541********5260 		7-26;支付卡号20位
        // 000025				27-32凭证号6位
        // 000000000038			33-44金额12位
        // 交 易 成 功          		45-84错误描述 40位               
        // 898110280621146			85-99 商户号15位
        // 77527390			100-107银行的终端号8位
        // 000001				108-113批次号6位
        // 0921				114-117交易日期4位
        // 101320				118-123交易时间6位
        // 15563346686W			124-135参考号12位
        //     136-141授权号6位
        // 513位
        if($regChannel == 'RWZB')
        {   
            $POSPayStr = '00                              '.$transactionAmount.'                                                                     '.$transactionDate.$transactionTime.$retrievalRefNum.'                                                                                                                                                                                                                                                                                                                                                                                          ';
            $payType = 'MISSCAN';
        }else
        {
            //取消其他渠道不退费 不传支付串
            $POSPayStr = '';
            $payType = '';
        }
        
        $str = ' <Request>
                    <TradeCode>2002</TradeCode>
                    <ExtOrgCode></ExtOrgCode>
                    <ClientType></ClientType>
                    <HospitalId>'.$hospitalCode.'</HospitalId>
                    <ExtUserID>'.$devCode.'</ExtUserID>
                    <TransactionId></TransactionId>
                    <OrderCode>'.$regNo.'</OrderCode>
                    <PayDetails>
                        <PayModeCode>'.$payType.'</PayModeCode>
                        <TradeChannel>'.$regChannel.'</TradeChannel>
                        <PayAccountNo></PayAccountNo>
                        <PayAmt>'.$cash.'</PayAmt>
                        <PlatformNo></PlatformNo>
                        <OutPayNo>'.$tradeNo.'</OutPayNo>
                        <PayChannel></PayChannel>
                        <POSPayStr>'.$POSPayStr.'</POSPayStr>
                        <PayDate>'.$date.'</PayDate>
                        <PayTime>'.$time.'</PayTime>
                    </PayDetails>
                </Request>';
        $result = $this->reqSoap($str,'CancelOrder','Input');
        $result = strstr($result, "<Response>");
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        Log::write("取消预约his处理返回：" . $result, '', $type = '', $destination = self::$LOGS_PATH);
        // 执行成功
        if ($rel['ResultCode'] == '0') 
        {
            //预约挂号时，2020年11月3日17:17:10 邵冠亚
            //融威的医保病人和自费病人需要退钱，其他渠道预约的不需要退钱
            $datarow_attr_ary = array();
            $datarow_attr_ary['patientId'] = '';
            $datarow_attr_ary['regNo'] = ''; 
            $datarow_attr_ary['regDate'] = '';
            $datarow_attr_ary['deptCode'] = '';
            $datarow_attr_ary['deptName'] = '';
            $datarow_attr_ary['period'] = '';
            $datarow_attr_ary['fee'] = '';
            $datarow_attr_ary['scheduleNo'] = '';
            $datarow_attr_ary['refundFlag'] = $regChannel =='RWZB'?1:0;// 1退款  0不退款
            $datarow_attr_ary['regStatusFlag'] = '预约已取消';
            $baseData=$datarow_attr_ary;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '成功','data' => $baseData);
            Log::write("取消预约内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        } else {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => '');
            Log::write("取消预约内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }

    /**
     * 预约确认
     */
    public function appoint($parameters = '')
    {
        Log::write("获取预约保存列表内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $hospitalCode=$reqData['hospitalCode'];
        $scheduleNo=$reqData['scheduleNo'];
        $scheduleDate=$reqData['scheduleDate'];
        $period=$reqData['period'];
        $regNo=$reqData['regNo'];
        $patientId=$reqData['patientId'];
        $payType=$reqData['payType'];
        $tradeNo=$reqData['tradeNo'];
        $outTradeNo=$reqData['outTradeNo'];
        $payCardNo=$reqData['payCardNo'];
        $chargeTotal=$reqData['chargeTotal'];
        $cash=$reqData['cash'];
        $devCode=$reqData['devCode'];
        $patientName=$reqData['patientName'];//需前端传患者姓名
        $idCard=$reqData['idNo'];//需前端传患者身份证号
        $CardNo=$reqData['treatCardNo'];//需前端传患者卡号
        $cardType=$reqData['treatCardType'];//需前端传患者就诊类型
        $gender=$reqData['gender'];
        $deptCode=$reqData['deptCode'];
        $doctorCode=$reqData['doctorCode'];
        $transactionTime=$reqData['transactionTime'];//交易时间
        $transactionDateWithYear=$reqData['transactionDateWithYear'];//交易日期
        $retrievalRefNum=$reqData['retrievalRefNum'];//检索参考号
        
        switch ($cardType) {
            case '01'://yb
                $cardType='202';//预约202医保，3不行
                break;
            case '03'://jzk
                $cardType='2';
                break;
            case '04'://jyt
                $cardType='03';//4不行  03可以
                break;
        }   
        //支付方式
        // ZZJJYT	自助机京医通  HIS
        // MISSCAN	自助机POS通
        // MISPOS	自助机银行卡
        // 1 微信支付 2支付宝 3-银联 4-京医通余额  我方
        switch ($payType) 
        {
            case '1':
                $payType='MISSCAN';
                break;
            case '2':
                $payType='MISSCAN';
                break;
            case '3':
                $payType='MISPOS';
                break;
            case '4':
                $payType='ZZJJYT';
                break;
            case '9':
                $payType='QT';
                break;
        }
        //如果是京医通余额和医保卡余额不需要传输交易信息  sgy
        if($payType == 'MISSCAN' || $payType == 'MISPOS' )
        {
            
            $transactionTime=$reqData['relData']['transactionTime'];//交易时间
            $transactionDate=$reqData['relData']['transactionDate'];//交易日期
            $retrievalRefNum=$reqData['relData']['retrievalRefNum'];//检索参考号
            $transactionAmount=str_pad($reqData['relData']['transactionAmount'],12,"0",STR_PAD_LEFT);//交易金额
            // 00				0-2 交易结果描述
            // WXZF				3-6收单行(发卡行代码)
            // 134541********5260 		7-26;支付卡号20位
            // 000025				27-32凭证号6位
            // 000000000038			33-44金额12位
            // 交 易 成 功          		45-84错误描述 40位               
            // 898110280621146			85-99 商户号15位
            // 77527390			100-107银行的终端号8位
            // 000001				108-113批次号6位
            // 0921				114-117交易日期4位
            // 101320				118-123交易时间6位
            // 15563346686W			124-135参考号12位
            //     136-141授权号6位
            // 513位
            $POSPayStr = '00                              '.$transactionAmount.'                                                                     '.$transactionDate.$transactionTime.$retrievalRefNum.'                                                                                                                                                                                                                                                                                                                                                                                          ';
        }else
        {
            $POSPayStr = '';
        }
        // 预约确认  1000  
        //<TradeChannel>POSYLSW</TradeChannel>
        $str = '<Request>
                <TradeCode>1000</TradeCode>
                <ExtOrgCode>RWZB</ExtOrgCode>
                <ClientType></ClientType>
                <HospitalId>'.$hospitalCode.'</HospitalId>
                <ExtUserID>'.$devCode.'</ExtUserID>
                <TransactionId></TransactionId>
                <ScheduleItemCode>'.$scheduleNo.'</ScheduleItemCode>
                <CardNo>'.$CardNo.'</CardNo>
                <CardType>'.$cardType.'</CardType>
                <CredTypeCode></CredTypeCode>
                <IDCardNo></IDCardNo>
                <TelePhoneNo></TelePhoneNo>
                <MobileNo></MobileNo>
                <PatientName></PatientName>
                <PayFlag></PayFlag>
                <PayModeCode>'.$payType.'</PayModeCode>
                <PayBankCode></PayBankCode>
                <PayCardNo></PayCardNo>
                <PayFee>'.$cash.'</PayFee>
                <PayInsuFee></PayInsuFee>
                <PayInsuFeeStr></PayInsuFeeStr>
                <PayTradeNo>'.$tradeNo.'</PayTradeNo>
                <LockQueueNo></LockQueueNo>
                <Gender></Gender>
                <Address></Address>
                <HISApptID></HISApptID>
                <SeqCode></SeqCode>
                <AdmitRange></AdmitRange>
                <PayTradeStr></PayTradeStr>
                <PayDetails>
                    <PayModeCode>'.$payType.'</PayModeCode>
                    <TradeChannel>RWZB</TradeChannel>
                    <PayAccountNo></PayAccountNo>
                    <PayAmt>'.$cash.'</PayAmt>
                    <PlatformNo>'.$tradeNo.'</PlatformNo>
                    <OutPayNo>'.$tradeNo.'</OutPayNo>
                    <PayChannel>RWZB</PayChannel>
                    <POSPayStr>'.$POSPayStr.'</POSPayStr>
                    <PayDate>'.$date.'</PayDate>
                    <PayTime>'.$time.'</PayTime>
                </PayDetails>
        </Request>';
        Log::write("获取预约保存内部调用his发送：" . var_export($str, true), '', $type = '', $destination = self::$LOGS_PATH);
        $result = $this->reqSoap($str,'BookService');
        // 写死的
        // $result = '<Response><ResultCode>0</ResultCode><ResultContent>预约成功</ResultContent><OrderCode>856||3||1</OrderCode><SeqCode>郑鹏飞</SeqCode><RegFee>80</RegFee><AdmitRange>全天</AdmitRange><AdmitAddress>融威众邦自助报道</AdmitAddress><OrderContent>000008235038^15942484^测试8235C^男^1 号(全天)^1^眼科普通门诊(南区)^郑鹏飞^2020-09-25^20:49^2020-09-26^65647^74996^2020-09-26^00:01^01:01^^全天^眼科普通门诊(南区)^41^0^郑鹏飞</OrderContent><TransactionId></TransactionId></Response>';
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);

        // 执行成功
        if ($rel['ResultCode'] == '0') {
            $return_data = array();
            $return_data['receiptNo']=$rel['OrderCode'];
            $return_data['chargeTotal']=$rel['RegFee'];
            $return_data['cash']=$rel['RegFee'];
            $baseData=$return_data;
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '成功','data' => $baseData);
            Log::write("获取预约保存内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        } else {
            // 失败
            header('Content-Type:application/json;charset=utf8');
            $datarow['isCanRefund']='0';
            $baseData=$datarow;
            $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => $baseData);
            Log::write("获取预约保存内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            echo json_encode($result);
        }
    }

    //通知平台取号完成
    public function takeNo($hospitalCode,$reg_no,$receiptNo,$treatCardNo,$treatCardType,$tSign,$tcert,$tradeNo,$insurPersonInfo='',$insurDivedeInfo='',$insurTradeInfo=''){
        /*
            --- 取号
            prc_jyt_getreg
            (receiptNo          IN  VARCHAR2, ---锁号返回值中his_reg_no
            treatCardNo         IN  VARCHAR2,--京医通卡号或门诊卡号
            treatCardType       IN  VARCHAR2,--卡类型京医通1，门诊卡号3
            par_tradeno         IN  VARCHAR2,--取号交易流水号
            par_sign            IN  VARCHAR2,--签名值 --传空
            par_cert            IN  VARCHAR2,--序列号 --传空
            par_get_person_info IN  VARCHAR2,--医保患者读卡信息（xml  <![CDATA[]]> 用cdata标注）
            par_divide          IN  clob,--医保分解输出串（xml  <![CDATA[]]> 用cdata标注）
            par_dividetrade     IN  VARCHAR2,--医保提交返回串（xml  <![CDATA[]]> 用cdata标注）
            par_mechine_code    IN VARCHAR2, --机器操作员号传 800032
            par_hoscode         IN VARCHAR2,  --院区编码 H110322
            PAR_APPCODE         OUT INTEGER,
            PAR_ERRORMSG        OUT VARCHAR2
            )
        */
        $time  = date("YmdHis");//时间戳    
        $url = "http://192.168.98.50/ws/patient/tickets/take";
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
        $xml .= '<request>';
        $xml .= '<time_stamp>'.$time.'</time_stamp>';
        $xml .= '<input>';
        $xml .= '<hos_code>'.$hospitalCode.'</hos_code>';
        $xml .= '<reg_no>'.$reg_no.'</reg_no>';
        $xml .= '<his_reg_no>'.$receiptNo.'</his_reg_no>';
        $xml .= '<card_no>'.$treatCardNo.'</card_no>';
        $xml .= '<card_type>'.$treatCardType.'</card_type>';
        $xml .= '<sign>'.$tSign.'</sign>';
        $xml .= '<cert>'.$cert.'</cert>';
        $xml .= '<trade_no>'.$tradeNo.'</trade_no>';
        $xml .= '<refund_no>'.$refundNo.'</refund_no>';
        $xml .= '<get_person_info>'.$insurPersonInfo.'</get_person_info>';
        $xml .= '<divide>'.$insurDivedeInfo.'</divide>';
        $xml .= '<trade>'.$insurTradeInfo.'</trade>';
        $xml .= '</input>';
        $xml .= '</request>';
        $resp = $this->httpSendPost($url,$xml);
        if($resp['ret_code'] != 0)
        {
            $rel['success'] = -1;;//失败
            $rel['err_test'] = $resp['ret_msg'];
        }else{
            $rel['success'] = 0;
            $rel['info'] = $resp['output'];
        }
        return $rel;
    }

    /**/
    /**
     *患者建档
     */
    public function patientCreate($parameters = ''){
        Log::write("患者建档内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $cardType=$reqData['treatCardType'];
        $CardNo=$reqData['treatCardNo'];
        $patientType=$reqData['patientType'];// 0自费  1医保
        $name=$reqData['name'];
        $idNo=$reqData['idNo'];
        $idType=$reqData['idType'];
        $gender=$reqData['gender'];
        $birthday=$reqData['birthday'];
        $insurCardNo=$reqData['insurCardNo'];
        $address=$reqData['address'];
        $mobile=$reqData['mobile'];
        $devCode=$reqData['devCode'];
        $infoXml=$reqData['infoXml'];//新增入参：医保建卡出参
        $jytXml=$reqData['jytXml'];//新增入参：京医通建卡出参
        switch ($cardType) 
        {
            case '01'://yb
                $cardType='202';//预约202医保，3不行
                break;
            case '03'://jzk
                $cardType='2';
                break;
            case '04'://jyt
                $cardType='03';
                break;
        }  
        //
        if($patientType == '0')
        {
            $patientType = '01';
        }else if($patientType == '1')
        {
            $patientType = '02';
        }
        //202医保患者
        if($cardType == '202') {
			$ybInfo=$this->jieXi($infoXml,'YYT_YB_GET_PATI');
            $CardNo=$ybInfo['treatCardNo'];
            /*if (substr($infoXml,0,1) == '0') {
                $ybInfo=$this->jieXi($infoXml,'YYT_YB_GET_PATI');
                $CardNo=$ybInfo['treatCardNo'];
            } else {
                header('Content-Type:application/json;charset=utf8');
                $partienResultData['isCreate']=1;
                $baseData=$partienResultData;
                $result = array('code' => 1,'msg' => '医保读取信息失败','data' => $baseData);
                Log::write("获取患者信息内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            }*/
        } 
        //解析京医通建卡出参开始
        if($cardType == '03' && $jytXml != '')
        {   
            // $jytCreateXml = simplexml_load_string($jytXml);
            // $jytCreatData = json_decode(json_encode($jytCreateXml),true);
            $xml = trim($jytXml);
            $data = simplexml_load_string(mb_convert_encoding(htmlspecialchars_decode($xml), 'UTF-16', 'UTF-8'));
            $jytCreatData = json_decode(json_encode($data),true);
            if($jytCreatData['state']['@attributes']['success'] == 'true' && $jytCreatData['state']['@attributes']['needconfirm'] == 'false' && !isset($jytCreatData['warning']))
            {
                //京医通建卡成功
                $CardNo = $jytCreatData['cardno'];//京医通卡号
            }else
            {
                //京医通建卡失败
                header('Content-Type:application/json;charset=utf8');
                $result = array('code' => 1,'msg' =>'京医通建卡失败','data' => '');
                Log::write("京返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            }
        }
         //解析京医通建卡出参结束
         //判断卡类型 给HIS传参
         if($cardType == '03')
         {
            $InsureCardNo = '';//HIS建卡入参  社保卡号
            $InsureCardFlag = 'N';//同上 社保标志(Y=社保患者，N=非社保患者)
         }else
         {
            $InsureCardNo = $CardNo;//HIS建卡入参  社保卡号
            $InsureCardFlag = 'Y';//同上 社保标志(Y=社保患者，N=非社保患者)
         }
         //证件类型对照
        //  $idTypeArr =
        //  [   
        //      '1'=>'1',
        //      '2'=>'8',
        //      '3'=>'6',
        //      '4'=>'2',
        //      '5'=>'7',
        //      '6'=>'4',
        //      '7'=>'5',
        //      '8'=>'99'
        //  ];
        // $idTypeArrNew = array_flip($idTypeArr);//将key和value调换位置
         $str ='<Request>
             <TradeCode>3014</TradeCode>
             <CardTypeCode>'.$cardType.'</CardTypeCode>
             <PatientCard>'.$CardNo.'</PatientCard>
             <SecurityNo>123456</SecurityNo>
             <ChipSerialNo></ChipSerialNo>
             <PatientType>'.$patientType.'</PatientType>
             <PatientName>'.$name.'</PatientName>
             <Sex>'.$gender.'</Sex>
             <DOB>'.$birthday.'</DOB>
             <MaritalStatus></MaritalStatus>
             <Nation></Nation>
             <Occupation></Occupation>
             <Nationality></Nationality>
             <IDType>01</IDType>
             <IDNo>'.$idNo.'</IDNo>
             <Address>'.$address.'</Address>
             <AddressLocus></AddressLocus>
             <Zip></Zip>
             <Company></Company>
             <CompanyAddr></CompanyAddr>
             <CompanyZip></CompanyZip>
             <CompanyTelNo></CompanyTelNo>
             <TelephoneNo></TelephoneNo>
             <Mobile>'.$mobile.'</Mobile>
             <ContactName></ContactName>
             <ContactAddress></ContactAddress>
             <Relation></Relation>
             <ContactTelNo></ContactTelNo>
             <InsureCardFlag>'.$InsureCardFlag.'</InsureCardFlag>
             <InsureCardNo>'.$InsureCardNo.'</InsureCardNo>
             <UserID>'.$devCode.'</UserID>
             <TerminalID></TerminalID>
             <TransactionId></TransactionId>
             <CardDepositAmt></CardDepositAmt>
             <PayModeCode></PayModeCode>
             <PayBankCode></PayBankCode>
             <PayCardNo></PayCardNo>
             <ChargeDepositAmt></ChargeDepositAmt>
             <AccountPassword></AccountPassword>
             <TheArea></TheArea>
             <PatientID></PatientID>
             <BankCode></BankCode>
             <BindFlag></BindFlag>
             <SignedStatus></SignedStatus>
             <HTBankCardNo></HTBankCardNo>
             <BankTradeInfo>
             </BankTradeInfo>
         </Request>';

         $result = $this->reqSoap($str,'CreatCard');
    //      $result = '<Response>
    //      <TradeCode></TradeCode>
    //      <PatientCard>000008235038</PatientCard>
    //      <SecurityNo>123456</SecurityNo>
    //      <PatientID>0007630937</PatientID>
    //      <ResultCode>0</ResultCode>
    //      <ResultContent>建卡成功</ResultContent>
    //      <ActiveFlag></ActiveFlag>
    //      <TransactionId></TransactionId>
    //      <DepositAmount>0</DepositAmount>
    //  </Response>';
         Log::write("患者建档调用发送his报文：" . var_export($str, true), '', $type = '', $destination = self::$LOGS_PATH);
         $OB_OutXml = simplexml_load_string($result);
         $rel = json_decode(json_encode($OB_OutXml),true);
         if ($rel['ResultCode'] == '0') 
         {
             $partienResultData = array();
             $partienResultData['complete'] = '1';
             $partienResultData['patientId'] = $rel['PatientID'];
             $partienResultData['cardNo'] = $rel['PatientCard'];
             $partienResultData['name'] = $name;
             $partienResultData['gender'] = $gender;
             $partienResultData['birthday'] = $birthday;
             $partienResultData['mobile'] = $mobile;
             $partienResultData['address'] = $address;
             $baseData=$partienResultData;
             header('Content-Type:application/json;charset=utf8');
             $result = array('code' => 0,'msg' => '成功','data' => $baseData);
             Log::write("患者建档内部调用返回处理后报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
             return $result;
         } else {
             header('Content-Type:application/json;charset=utf8');
             $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => '');
             Log::write("患者建档内部调用返回处理后的报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
             return $result;
         }
    }
    
    /**
    *医保获取分解
    */
    public function getDivideParam($parameters = ''){
        Log::write("获取医保分解串内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=$parameters;
        $patientId=$reqData['patientId'];
        $cardType=$reqData['treatCardType'];
        $CardNo=$reqData['treatCardNo'];
        $scheduleNo=$reqData['scheduleNo'];
        $devCode=$reqData['devCode'];
        $hospitalCode=$reqData['hospitalCode'];
        $businessType= $reqData['businessType'];
        $insurTradeNo= $reqData['insurTradeNo'];
        $orderNos= $reqData['orderNos'];
        $feeData= $reqData['feeData'];
        $method=$reqData['method'];
        $receiptNo=$reqData['receiptNo'];
        $medTradeNo=$reqData['medTradeNo'];
        $divXml=$reqData['divXml'];
        $saveXml=$reqData['saveXml'];
        $infoXml=$reqData['infoXml'];//医保二维码读卡串
        $YBElectronicCode=$reqData['YBElectronicCode'];//医保二维码读卡串
        $multiclass=$reqData['multiclass'];//医保类型1医保卡2医保二维码
        switch ($cardType) {
            case '01'://yb
                $cardType='3';
                break;
            case '03'://jzk
                $cardType='2';
                break;
            case '04'://jyt
                $cardType='4';
                break;
        }

        if($method =='YYT_YB_GET_PATI')
        {
        	if ($multiclass=='1') {
        		$NetCheck='BJ';
        		$ExpStr='cardno^idno^personname^sex^birthday^fundtype^hospflag^BJ^';
        	} else {
        		$NetCheck='QR';
        		$ExpStr='cardno^idno^personname^sex^birthday^fundtype^hospflag^BJ^'.$infoXml;
        	}
            $ResultData['DivideParam'] = array('divSide' =>'DHYB','NetCheck'=>$NetCheck,'ExpStr'=>$ExpStr);
        }elseif ($method=='YYT_YB_GH_CALC' || $method == 'YYT_YB_QH_CALC' )
        {
            //今日挂号分解入参数
            //1106  获取医保信息
            $str = '<Request>
                        <TradeCode>1106</TradeCode>
                        <ExtUserID>'.$devCode.'</ExtUserID>
                        <ScheduleItemCode>'.$scheduleNo.'</ScheduleItemCode>
                        <PatientID>'.$patientId.'</PatientID>
                        <CardNo>'.$CardNo.'</CardNo>
                        <CardType>'.$cardType.'</CardType>
                        <InsuCardData></InsuCardData>
                        <IOType>Reg</IOType>
                </Request>';
            $result = $this->reqSoap($str,'GetInsuRegPara');
            $OB_OutXml = simplexml_load_string($result);
            $rel = json_decode(json_encode($OB_OutXml),true);
            /* 
                如果获取医保分解入参失败的话
                此时应该前端医保划价失败的信息
                2020年11月9日18:52:17
                sgy
                应该展示给患者HIS返回的失败信息
            */
            if ($rel['ResultCode'] == '0')
            {
            	/*if ($multiclass=='1') {
	                $diviStr['HisAdmInfo'] = $rel['ExpString'];
            	} else {
            		$ExpString=$rel['ExpString'];
            		$str000=split('!', $ExpString);
            		$diviStr['HisAdmInfo']=$str000[0].'^^^Y^^^^^^^^^^QR^'.$YBElectronicCode.'!'.$str000[1];
            	}*/
            	
                $diviStr['HisAdmInfo'] = $rel['ExpString'];
                $diviStr['divSide'] = 'DHYB';
                $diviStr['UserId'] = $rel['UserID'];
                $diviStr['ExpStr'] = 'Y';
                $diviStr['businessType'] = 'GH';
                $ResultData['DivideParam'] = $diviStr;
            }else
            {
                header('Content-Type:application/json;charset=utf8');
                $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => '');
                Log::write("HIS医保挂号/取号划价内部调用返回处理后报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            }
        }elseif ($method =='YYT_YB_GH_SAVE' || $method == 'YYT_YB_QH_SAVE') 
        {  
            $diviStr['divSide'] = 'DHYB';
            $diviStr['InsuAdmDr'] = $insurTradeNo;
            $diviStr['UserId'] = $devCode;     
            $diviStr['ExpStr'] = ''; 
            $diviStr['businessType'] = 'GH';
            $ResultData['DivideParam'] = $diviStr;
        }elseif($method =='YYT_YB_SF_CALC')
        {
            $OrderSum = $feeData[0]['orderFeeHis'];//2020年10月9日16:19:29 sgy  此处修改为将新冠检查的费用进行抹除后，传递给HIS会报错；实际上金额是抹除了，但是传递给HIS需要时未抹除的金额 
            $diagnoseNo = $feeData[0]['diagnoseNo'];
            /* 
                此处于2020年11月9日18:57:57 修改了 4905接口的操作员编号入参
                sgy
            */
            $str = '<Request>
                    <TradeCode>4905</TradeCode>
                    <HospitalID></HospitalID>
                    <CardNo>'.$CardNo.'</CardNo>
                    <CardType>'.$cardType.'</CardType>
                    <SecrityNo>0</SecrityNo>
                    <PatientID>'.$patientId.'</PatientID>
                    <UserCode>'.$devCode.'</UserCode>
                    <TerminalID>'.$devCode.'</TerminalID>
                    <Adm>'.$diagnoseNo.'</Adm>
                    <OrderNo>'.$orderNos.'</OrderNo>
                    <OrderSum>'.$OrderSum.'</OrderSum>
                    <PayModeCode>QT</PayModeCode>
                    <ExpStr></ExpStr>
                </Request>';
            $result = $this->reqSoap($str,'ZZJCommonPay');
            $OB_OutXml = simplexml_load_string($result);
            $rel = json_decode(json_encode($OB_OutXml),true);
            //判断是否成功
            if($rel['ResultCode'] == "0")
            {
                $test  = substr($result,strpos($result,'&'));
                $hISInsuInfo = substr($test,0,strpos($test,']'));
                $hISInsuInfoArr = explode("&", $hISInsuInfo);  
                //{"divSide":"DHYB","strInvprtDr":"31999302","UserId":"5643","ExpStr":"N^330^^2^189^2^^^Y^^^31"} 
                $diviStr['divSide'] = 'DHYB';
                $diviStr['strInvprtDr'] = $hISInsuInfoArr['1'];
                $diviStr['UserId'] = $hISInsuInfoArr['2'];     
                $diviStr['ExpStr'] = $hISInsuInfoArr['3'];
                $diviStr['businessType'] = 'SF';
                $ResultData['DivideParam'] = $diviStr;
                // $ResultData['payReceiptNo'] = $rel['InvoiceList']['Invoice']['InvoiceNo']; 
                // $ResultData['totalAmount'] = $rel['InvoiceList']['Invoice']['InvoiceAmt'];  
                // $ResultData['isYb'] = $rel['InvoiceList']['Invoice']['InsuFlag'];
            }else
            {
                header('Content-Type:application/json;charset=utf8');
                $result = array('code' => 1,'msg' => $rel['ResultMsg'],'data' => '');
                Log::write("HIS医保划价内部调用返回处理后报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            }
             
        }elseif ($method =='YYT_YB_SF_SAVE'){
            //缴费保存
            // {"divSide":"DHYB","strInvprtDr":"31999298","UserId":"5643","ExpStr":"N^253^^2^189^2^^^Y^^^31"}
            $diviStr['divSide'] = 'DHYB';
            $diviStr['strInvprtDr'] = $receiptNo;
            $diviStr['UserId'] = '5643';     
            $diviStr['ExpStr'] = '';
            $diviStr['businessType'] = 'SF';
            $ResultData['DivideParam'] = $diviStr;
        }elseif ($method =='YYT_YB_GH_UNDO'){
            //医保挂号撤销 YYT_YB_GH_UNDO
            $ybInfo=$this->jieXi($divXml,'YYT_YB_GH_CALC');
            /* 
                2020年11月7日22:30:36
                当业务类型是yyqh时 不需要调用10016解锁HIS，因为没有调用HIS的划价接口
                只有是业务类型是其他情况时 才需要调用解锁解锁HIS
            */
            if(strtoupper($businessType) == 'YYQH')
            {
                    $diviStr['divSide'] = 'DHYB';
                    $diviStr['InsuAdmRowid'] = $ybInfo['InsuAdmDr'];
                    $diviStr['UserId'] = $devCode;
                    $diviStr['ExpStr'] = 'Y';
                    $diviStr['businessType'] = 'GH';
                    $ResultData['DivideParam'] = $diviStr;
            }else
            {
                /* 
                    假如医保挂号时，划价接口失败，
                    此时没有产生10016解锁所需的入参，会导致10016失败，
                    如果失败了不返回给前端医保退号入参的话，
                    会导致没有关闭医保初始化，下次读卡时就会报错
                    2020年11月9日18:30:41
                    sgy
                    此时注释掉判断HIS解锁失败的限制，无论HIS解锁是否成功都返回HIS需要解锁医保需要的入参
                */
                $str = '<Request>
                        <TradeCode>10016</TradeCode>
                        <ClientType></ClientType>
                        <HospitalID></HospitalID>
                        <ExtUserID>'.$devCode.'</ExtUserID>
                        <ScheduleItemCode>'.$scheduleNo.'</ScheduleItemCode>
                        <TransactionId>'.$receiptNo.'</TransactionId>
                        <LockQueueNo>1</LockQueueNo>
                </Request>';
                $result = $this->reqSoap($str,'UnLockOrder');
                $OB_OutXml = simplexml_load_string($result);
                $rel = json_decode(json_encode($OB_OutXml),true);
                // 
               /*  if ($rel['ResultCode'] == '0') 
                { */
                $diviStr['divSide'] = 'DHYB';
                $diviStr['InsuAdmRowid'] = $ybInfo['InsuAdmDr'];
                $diviStr['UserId'] = $devCode;
                $diviStr['ExpStr'] = 'Y';
                $diviStr['businessType'] = 'GH';
                $ResultData['DivideParam'] = $diviStr;
               /*  }else{
                    header('Content-Type:application/json;charset=utf8');
                    $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => '');
                    Log::write("医保分解串内部调用返回处理后报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                    return $result;
                } */
            }
            
        }elseif ($method =='YYT_YB_SF_UNDO')
        {
            //医保缴费撤销 YYT_YB_SF_UNDO
            // {"divSide":"DHYB","strInvprtDr":"31999298","UserId":"5643","ExpStr":"N^253^^2^189^2^^^Y^^^31"}
            $ybInfo=$this->jieXi($saveXml,'YYT_YB_SF_SAVE');
            $OrderSum = $feeData[0]['orderFee'];
            $diagnoseNo = $feeData[0]['diagnoseNo'];
            /* 
                于2020年11月9日18:58:46 修改了 4910的操作员编号入参
                2020年11月9日18:59:05
            */
            $str = '<Request>
                    <TradeCode>4910</TradeCode>
                    <HospitalID></HospitalID>
                    <CardNo>'.$CardNo.'</CardNo>
                    <CardType>'.$cardType.'</CardType>
                    <SecrityNo>0</SecrityNo>
                    <PatientID>'.$patientId.'</PatientID>
                    <UserCode>'.$devCode.'</UserCode>
                    <TerminalID>'.$devCode.'</TerminalID>
                    <Invoicestr>'.$medTradeNo.'</Invoicestr>
                    <OrderNo>'.$orderNos.'</OrderNo>
                </Request>';
            $result = $this->reqSoap($str,'ZZJCommonPay');
            $OB_OutXml = simplexml_load_string($result);
            $rel = json_decode(json_encode($OB_OutXml),true);
            /* 
                逻辑类似于患者在缴费预结算失败后，不会产生撤销预结算所需要的参数，
                此时调用撤销预结算会失败，导致不返回后台 医保撤销预结算的入参
                2020年11月9日18:55:42
                sgy
                修改 UserId 操作员字段
            */
            // 执行成功
            if ($rel['ResultCode'] == '0') {
                $diviStr['divSide'] = 'DHYB';
                $diviStr['strInvprtDr'] = $ybInfo['strInvprtDr'];
                $diviStr['UserId'] = $devCode;     
                $diviStr['ExpStr'] = 'Y';
                $diviStr['businessType'] = 'SF';
                $ResultData['DivideParam'] = $diviStr;
            }else{
                header('Content-Type:application/json;charset=utf8');
                $result = array('code' => 1,'msg' => $rel['ResultContent'],'data' => '');
                Log::write("医保分解串内部调用返回处理后报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
                return $result;
            }
        }elseif ($method=='YYT_YB_GH_Notice') {
        	if ($businessType=='ZZJF') {
        		$ExpStr='^OPDivide';
        	} else {
        		$ExpStr='^OPReg';
        	}
            $diviStr['divSide'] = 'DHYB';
            $diviStr['businessType'] = 'InsuOPFinishedNotice';
            $diviStr['Handle'] = 0;     
            $diviStr['UserId'] = $devCode;
            $diviStr['Rowid'] = $medTradeNo;
            $diviStr['AdmSource'] = '';
            $diviStr['AdmReasonId'] = '';
            $diviStr['ExpStr'] = $ExpStr;
            $ResultData['DivideParam'] = $diviStr;
        }
        $baseData=$ResultData;
        header('Content-Type:application/json;charset=utf8');
        $result = array('code' => 0,'msg' => '成功','data' => $baseData);
        Log::write("医保分解串内部调用返回处理后报文：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
        return $result;
    } 

    /**
    *解析前台医保方法返回串
    */
    public function jieXi($YBxml = '',$method = '')
    {
        //解析医保患者信息 Ok
        if ($method =='YYT_YB_GET_PATI') {
            $yb_arr  =  explode("|",$YBxml);
            $ybInfo['treatCardNo'] =  $yb_arr["0"];   //社保卡卡号
            // $ybInfo["ic_no"]   =  $yb_arr["1"];   // 医保应用号
            $ybInfo["id_no"]   =  $yb_arr["2"];   // 身份证号
            $ybInfo["personname"]  =  $yb_arr["3"]; // 姓名
            $ybInfo["sex"]    =  $yb_arr["4"];    // 性别
            $ybInfo["birthday"]   =  $yb_arr["5"]; // 出生日期
            $ybInfo["fundtype"]   =  $yb_arr["6"]; //  险种类型:老少,居民,职工,公疗
            // $ybInfo["fromhosp"]    =  $yb_arr["9"]; //转诊医院编码
            // $ybInfo["fromhospdate"] =  $yb_arr["10"]; //转诊时限
            // $ybInfo["isyt"]        =  $yb_arr["11"]; //预提人员标示
            // $ybInfo["jclevel"]   =  $yb_arr["12"]; //军残等级
            // $ybInfo["hospflag"]  =  $yb_arr["13"]; // 在院标示
            // $ybInfo["ischronichosp"]  =  $yb_arr["16"]; //是否本人慢病定点医院
            // $ybInfo["chroniccode"]  =  $yb_arr["17"]; //慢病编码
            // $ybInfo["ErrStr"]   =  $yb_arr["18"]; // 读卡错误信息
            // $ybInfo["Warning"]  =  $yb_arr["19"]; //读卡警告信息
            $ybInfo["persontype"]  =  $this->getPersonType($yb_arr["7"]); //参保人员类别
            $ybInfo["personcount"]  =  $yb_arr["8"]; //个人帐户余额
            $ybInfo["isspecifiedhosp"]  =  $yb_arr["15"]; //本人定点医院状态 0:本地红名单，默认为本人定点医院； 1：是本人定点医院、A类医院、专科医院、中医医院；2：不是本人定点医院 3：转诊
            $ybInfo["isinredlist"]  =  $yb_arr["14"]; //是否在红名单
            $ybInfo["Warning"]  =  $yb_arr["19"]; //读卡警告信息
        }
        //解析医保挂号分解 ---    0^7202257^!0.0034!40.0035!10.00^^
        elseif ($method=='YYT_YB_GH_CALC'){
            //挂号分解
            //  0^7202257^!0.0034!40.0035!10.00^^ ghfj
            // 原始的：0^7202257^!0.0034!40.0035!10.00^^
            // 重组后：0^7202256^1!0.00@34!40.00@35!10.00
            //挂号分解开始_____________________________
            $ybStr = $YBxml;//"0^7202257^!0.0034!40.0035!10.00^^";
            $ybArr = explode("^",$ybStr);
            $ybInfo['InsuAdmDr'] = $ybArr[1];//划价返回标识
            $feeInfo = $ybArr[2];
            $feeInfoArr = explode("!",$feeInfo);
            $ybInfo['cash'] = substr($feeInfoArr['1'],0,strpos($feeInfoArr[1],''));//自付金额 
            $ybInfo['rowidCash']  = substr($feeInfoArr['1'],-2);//现金支付方式rowid 
            $ybInfo['fund'] = substr($feeInfoArr['2'],0,strpos($feeInfoArr[2],''));//医保统筹支付金额 
            $ybInfo['rowidCount']  = substr($feeInfoArr['2'],-2);//医保账户支付方式rowid 
            $ybInfo['personcountpay']  = $feeInfoArr['3'];//医保账户支付金额
        }
        //解析医保挂号保存  --- 0^7202257^1!0.0034!40.0035!10.00^190.00
        elseif($method=='YYT_YB_GH_SAVE'){
            //挂号保存
            $ybStr = $YBxml;//"0^7202257^1!0.0034!40.0035!10.00^190.00";
            $ybInfo['hisSavePar'] = str_replace('', '@', $ybStr);
            $ybArr = explode("^",$ybStr);
            $InsuAdmDr = $ybArr[1];
            $feeInfo = $ybArr[2];
            $feeInfoArr = explode("!",$feeInfo);
            $ybInfo['cash'] = substr($feeInfoArr['1'],0,strpos($feeInfoArr[1],''));//自付金额 
            $ybInfo['rowidCash']  = substr($feeInfoArr['1'],-2);//现金支付方式rowid 
            $ybInfo['fund'] = substr($feeInfoArr['2'],0,strpos($feeInfoArr[2],''));//医保统筹支付金额 
            $ybInfo['rowidCount'] = substr($feeInfoArr['2'],-2);//医保账户支付方式rowid 
            $ybInfo['personcountpay'] = $ybArr['3'];//医保账户余额
        }
        //解析医保缴费分解   ----  0^^0.00^31999302^^^34^85.4135^48.65
        elseif($method =='YYT_YB_SF_CALC'){
            //缴费分解
            $ybStr = $YBxml;//"0^^0.00^31999302^^^34^85.4135^48.65";
            $ybArr = explode("^",$ybStr);
            $ybInfo['cash']  = $ybArr['2'];//自付金额
            $ybInfo['InvprtDr'] = $ybArr['3'];//发票表
            // $paymid  = substr($ybArr['6'],-2);//现金支付方式rowid
            $ybInfo['fund'] = substr($ybArr['7'],0,strpos($ybArr['7'],''));//医保统筹支付金额
            $ybInfo['personcountaftersub'] = $ybArr['8'];//个人账户支付金额
        }
        //解析缴费医保保存  -----0^7582632^0.00^31999302^31^^151.3534^85.4135^48.65
        elseif($method =='YYT_YB_SF_SAVE'){
            //缴费保存
            $ybStr = $YBxml;//"0^7582632^0.00^31999302^31^^151.3534^85.4135^48.65";
            $ybArr = explode("^",$ybStr);
            $ybInfo['strInvprtDr'] = $ybArr['1'];//自付金额
            $ybInfo['cash'] = $ybArr['2'];//自付金额
            $ybInfo['InvprtDr'] = $ybArr['3'];//发票表
            $ybInfo['paymid'] = substr($ybArr['6'],-2);//现金支付方式rowid
            $ybInfo['personcountaftersub']  = substr($ybArr['6'],0,strpos($ybArr['6'],''));//结算后医保账户余额
            $ybInfo['fund']  = substr($ybArr['7'],0,strpos($ybArr['7'],''));//医保统筹支付金额
            $ybInfo['personcountpay']  = $ybArr['8'];//医保账户支付金额
        }
        return $ybInfo;
    }

    /**
    * 信息查询
    * 
    */
    public function information($parameters = '') {
        Log::write("获取查询内部调用原始入参：" . var_export($parameters, true), '', $type = '', $destination = self::$LOGS_PATH);
        $reqData=(array)$parameters;
        $pyabbr=$reqData['pyabbr'];
        $flag=$reqData['flag'];
        $type=$reqData['type'];
        if($type == '0')
        {
            if($flag == '0')
            {
                //药品
                $str = '<Request>
                            <TradeCode>90008</TradeCode>
                            <Alias>'.$pyabbr.'</Alias>
                        </Request>';
            }else if($flag == '1')
            {
                //非药品
                $str = '<Request>
                        <TradeCode>90009</TradeCode>
                        <Alias>'.$pyabbr.'</Alias>
                    </Request>';
        
            }
        }
        $result = $this->reqSoap($str,'ZZJCommonPay');
        Log::write("获取查询内部调用his发送：" . var_export($str, true), '', $type = '', $destination = self::$LOGS_PATH);
        $OB_OutXml = simplexml_load_string($result);
        $rel = json_decode(json_encode($OB_OutXml),true);
        
        // 执行成功
        if ($rel['ResultCode'] == '0') {
            if($flag == '0')
            {
                if ($rel['MedItemS']['MedItem']['SerialNo'])
                {
                    $Items[]=$rel['MedItemS']['MedItem'];
                } else {
                    $Items=$rel['MedItemS']['MedItem'];
                }
            }else if($flag == '1')
            {
                if ($rel['TarItemS']['TarItem']['SerialNo'])
                {
                    $Items[]=$rel['TarItemS']['TarItem'];
                } else {
                    $Items=$rel['TarItemS']['TarItem'];
                }
            }
            for ($i=0; $i < count($Items); $i++) 
            {
                $datarow[$i]['itemName']=$Items[$i]['ItemDesc'];
                $datarow[$i]['parentName']=is_null($Items[$i]['MedCate'])?"":$Items[$i]['MedCate'];
                $datarow[$i]['specs']=is_null($Items[$i]['DrugForm'])?"":$Items[$i]['DrugForm'];
                $datarow[$i]['unit']=is_array($Items[$i]['Uom'])?'':$Items[$i]['Uom'];
                $datarow[$i]['price']=$Items[$i]['Price'];
                $datarow[$i]['py']='';
                $datarow[$i]['Factory']=is_array($Items[$i]['Factory'])?'':$Items[$i]['Factory'];
            }
            $baseData=$datarow;
            // echo "<pre>";
            // print_r($baseData);
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 0,'msg' => '成功','data' => $baseData);
            Log::write("获取查询内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        } else {
            header('Content-Type:application/json;charset=utf8');
            $result = array('code' => 1,'msg' => $rel['ErrorMsg'],'data' => '');
            Log::write("获取查询内部调用处理返回：" . var_export($result, true), '', $type = '', $destination = self::$LOGS_PATH);
            return $result;
        }
    }
    
    /**
    *计算日期之间的差值
    *
    */
    public function diffDay($day1,$day2){
        $second1=strtotime($day1);
        $second2=strtotime($day2);
        if ($second1>$second2) {
            $tmp=$second1;
            $second1=$second2;
            $second2=$tmp;
        }
        return round(($second2 - $second1) / 3600 /24);
    }
    /**
    *数组分组
    *
    */
    public function dataGroup($dataArr,$keyStr)
    {
        $newArr=[];
        foreach ($dataArr as $k => $val) {    //数据根据日期分组
            $newArr[$val[$keyStr]][] = $val;
        }
        return $newArr;
    }
    /*
    *获取身份类型
    *
    */
    protected function  getPersonType($persontype)
    {
        $str = '[
        {
            "id": 10,
            "name": "本市复读的学生"
        },
        {
            "id": 70,
            "name": "城镇无业居民"
        },
        {
            "id": 11,
            "name": "在职职工"
        },
        {
            "id": 71,
            "name": "三资退休人员"
        },
        {
            "id": 12,
            "name": "在职长期驻外职工"
        },
        {
            "id": 72,
            "name": "三资退休异地安置人员"
        },
        {
            "id": 13,
            "name": "在职二等乙级残疾军人"
        },
        {
            "id": 73,
            "name": "三资退职人员"
        },
        {
            "id": 14,
            "name": "城镇婴幼儿"
        },
        {
            "id": 74,
            "name": "三资退职异地安置人员"
        },
        {
            "id": 15,
            "name": "城镇学生"
        },
        {
            "id": 75,
            "name": "支援乡镇退休人员"
        },
        {
            "id": 16,
            "name": "城镇非在校生"
        },
        {
            "id": 76,
            "name": "支援乡镇退休异地安置人员"
        },
        {
            "id": 17,
            "name": "城镇老年人"
        },
        {
            "id": 77,
            "name": "支援乡镇退职人员"
        },
        {
            "id": 18,
            "name": "城镇长期异地居住的婴幼儿"
        },
        {
            "id": 78,
            "name": "支援乡镇退职异地安置人员"
        },
        {
            "id": 19,
            "name": "城镇长期异地居住的非在校生"
        },
        {
            "id": 79,
            "name": "长期异地居住的城镇残疾无业居民"
        },
        {
            "id": 20,
            "name": "城镇长期异地居住的老年人"
        },
        {
            "id": 80,
            "name": "长期异地居住的城镇无业居民"
        },
        {
            "id": 21,
            "name": "退休人员"
        },
        {
            "id": 81,
            "name": "退休人员（1）"
        },
        {
            "id": 22,
            "name": "异地安置的退休人员"
        },
        {
            "id": 82,
            "name": "退休异地安置人员（1）"
        },
        {
            "id": 23,
            "name": "退职二等乙级残疾军人"
        },
        {
            "id": 83,
            "name": "退职人员（1）"
        },
        {
            "id": 24,
            "name": "退休二等乙级残疾军人"
        },
        {
            "id": 84,
            "name": "退职异地安置人员（1）"
        },
        {
            "id": 25,
            "name": "退职人员"
        },
        {
            "id": 85,
            "name": "企业注销吊销退休人员"
        },
        {
            "id": 26,
            "name": "异地安置的退职人员"
        },
        {
            "id": 86,
            "name": "企业注销吊销退休异地安置人员"
        },
        {
            "id": 27,
            "name": "异地安置的离休人员"
        },
        {
            "id": 87,
            "name": "企业注销吊销退职人员"
        },
        {
            "id": 28,
            "name": "异地安置的离休司局级医疗照顾人员"
        },
        {
            "id": 88,
            "name": "企业注销吊销退职异地安置人员"
        },
        {
            "id": 29,
            "name": "异地安置的离休副部级医疗照顾人员"
        },
        {
            "id": 89,
            "name": "外地农民工"
        },
        {
            "id": 30,
            "name": "享受优诊医疗待遇的离休干部"
        },
        {
            "id": 90,
            "name": "本市农民工"
        },
        {
            "id": 31,
            "name": "普通离休人员"
        },
        {
            "id": 91,
            "name": "其它人员"
        },
        {
            "id": 32,
            "name": "老红军"
        },
        {
            "id": 92,
            "name": "公益性组织社会化退休人员"
        },
        {
            "id": 33,
            "name": "离休的司局级医疗照顾人员"
        },
        {
            "id": 93,
            "name": "公益性组织社会化退职人员"
        },
        {
            "id": 34,
            "name": "特殊全免人员"
        },
        {
            "id": 94,
            "name": "公益性组织异地安置退休人员"
        },
        {
            "id": 35,
            "name": "在职司局级医疗照顾人员"
        },
        {
            "id": 95,
            "name": "公益性组织异地安置退职人员"
        },
        {
            "id": 36,
            "name": "退休司局级医疗照顾人员"
        },
        {
            "id": 96,
            "name": "社区专职工作者社会化退休人员"
        },
        {
            "id": 37,
            "name": "在职副部级医疗照顾人员"
        },
        {
            "id": 97,
            "name": "社区专职工作者社会化退职人员"
        },
        {
            "id": 38,
            "name": "退休副部级医疗照顾人员"
        },
        {
            "id": 98,
            "name": "社区专职工作者异地安置社会化退休人员"
        },
        {
            "id": 39,
            "name": "离休的副部级医疗照顾人员"
        },
        {
            "id": 99,
            "name": "社区专职工作者异地安置社会化退职人员"
        },
        {
            "id": 40,
            "name": "享受最低保障的在职人员"
        },
        {
            "id": 101,
            "name": "在职高级知识分子"
        },
        {
            "id": 41,
            "name": "享受最低保障的退休人员"
        },
        {
            "id": 102,
            "name": "退休高级知识分子"
        },
        {
            "id": 42,
            "name": "享受最低保障的退职人员"
        },
        {
            "id": 103,
            "name": "离休高级知识分子"
        },
        {
            "id": 43,
            "name": "在职长期驻外司局级医疗照顾人员"
        },
        {
            "id": 104,
            "name": "在职长期驻外高级知识分子"
        },
        {
            "id": 44,
            "name": "在职长期驻外副部级医疗照顾人员"
        },
        {
            "id": 105,
            "name": "异地安置的退休高级知识分子"
        },
        {
            "id": 45,
            "name": "异地安置的退休司局级医疗照顾人员"
        },
        {
            "id": 106,
            "name": "异地安置的离休高级知识分子"
        },
        {
            "id": 46,
            "name": "异地安置的退休副部级医疗照顾人员"
        },
        {
            "id": 111,
            "name": "参事馆员"
        },
        {
            "id": 47,
            "name": "异地安置的退休二等乙级残疾军人"
        },
        {
            "id": 112,
            "name": "异地安置的参事馆员"
        },
        {
            "id": 48,
            "name": "异地安置的退职二等乙级残疾军人"
        },
        {
            "id": 113,
            "name": "异地安置的两院院士"
        },
        {
            "id": 49,
            "name": "在乡二等乙级残疾军人"
        },
        {
            "id": 114,
            "name": "在职长期驻外优诊待遇人员"
        },
        {
            "id": 50,
            "name": "城镇长期异地就读生"
        },
        {
            "id": 121,
            "name": "在职正市级医疗照顾人员"
        },
        {
            "id": 51,
            "name": "两院院士"
        },
        {
            "id": 122,
            "name": "退休正市级医疗照顾人员"
        },
        {
            "id": 52,
            "name": "在职优诊待遇人员"
        },
        {
            "id": 123,
            "name": "离休正市级医疗照顾人员"
        },
        {
            "id": 53,
            "name": "退休优诊待遇人员"
        },
        {
            "id": 124,
            "name": "在职长期驻外正市级医疗照顾人员"
        },
        {
            "id": 54,
            "name": "退职优诊待遇人员"
        },
        {
            "id": 125,
            "name": "异地安置的退休正市级医疗照顾人员"
        },
        {
            "id": 55,
            "name": "异地安置的退休优诊待遇人员"
        },
        {
            "id": 126,
            "name": "异地安置的离休正市级医疗照顾人员"
        },
        {
            "id": 56,
            "name": "异地安置的退职优诊待遇人员"
        },
        {
            "id": 127,
            "name": "在职特级教师"
        },
        {
            "id": 57,
            "name": "异地安置的享受优诊医疗待遇离休干部"
        },
        {
            "id": 128,
            "name": "退休特级教师"
        },
        {
            "id": 61,
            "name": "社会化退休人员"
        },
        {
            "id": 129,
            "name": "离休特级教师"
        },
        {
            "id": 62,
            "name": "社会化退休异地安置人员"
        },
        {
            "id": 130,
            "name": "在职长期驻外特级教师"
        },
        {
            "id": 63,
            "name": "社会化退职人员"
        },
        {
            "id": 131,
            "name": "异地安置的退休特级教师"
        },
        {
            "id": 64,
            "name": "社会化退职异地安置人员"
        },
        {
            "id": 132,
            "name": "异地安置的离休特级教师"
        },
        {
            "id": 65,
            "name": "企业改组退休人员"
        },
        {
            "id": 133,
            "name": "在职正部级医疗照顾人员"
        },
        {
            "id": 66,
            "name": "企业改组退休异地安置人员"
        },
        {
            "id": 134,
            "name": "退休正部级医疗照顾人员"
        },
        {
            "id": 67,
            "name": "企业改组退职人员"
        },
        {
            "id": 135,
            "name": "离休的正部级医疗照顾人员"
        },
        {
            "id": 68,
            "name": "企业改组退职异地安置人员"
        },
        {
            "id": 136,
            "name": "在职长期驻外正部级医疗照顾人员"
        },
        {
            "id": 69,
            "name": "城镇残疾无业居民"
        },
        {
            "id": 137,
            "name": "异地安置的退休正部级医疗照顾人员"
        },
        {
            "id": 138,
            "name": "异地安置的离休正部级医疗照顾人员"
        },
        {
            "id": 140,
            "name": "征地超转人员"
        },
        {
            "id": 141,
            "name": "异地安置征地超转人员"
        },
        {
            "id": 142,
            "name": "享受最低保障的征地超转人员"
        },
        {
            "id": 143,
            "name": "离休副市（部）长级标准人员"
        },
        {
            "id": 144,
            "name": "异地安置离休副市（部）长级标准人员"
        },
        {
            "id": 145,
            "name": "在职副市（部）长级标准人员"
        },
        {
            "id": 146,
            "name": "退休副市（部）长级标准人员"
        },
        {
            "id": 150,
            "name": "农村婴幼儿"
        },
        {
            "id": 151,
            "name": "农村学生"
        },
        {
            "id": 152,
            "name": "农村非在校生"
        },
        {
            "id": 153,
            "name": "农村老年人"
        },
        {
            "id": 154,
            "name": "农村长期异地居住的婴幼儿"
        },
        {
            "id": 155,
            "name": "农村长期异地居住的非在校生"
        },
        {
            "id": 156,
            "name": "农村长期异地居住的老年人"
        },
        {
            "id": 157,
            "name": "农村长期异地就读生"
        },
        {
            "id": 158,
            "name": "农村劳动力"
        },
        {
            "id": 159,
            "name": "农村残疾无业居民"
        },
        {
            "id": 160,
            "name": "农村长期异地居住的劳动力"
        },
        {
            "id": 161,
            "name": "农村长期异地居住的残疾劳动力"
        }
    ]';
    $strArr = json_decode($str,true);
    $typeStr = '';
    foreach ($strArr as $key => $value) 
    {
        if($value['id'] == $persontype)
        {
            $typeStr = $value['name'];
        } 
    }
    return  $typeStr;

    }
    protected function birthday($birthday)
    {
        list($year,$month,$day) = explode("-",$birthday);
        $year_diff = date("Y") - $year;
        $month_diff = date("m") - $month;
        $day_diff  = date("d") - $day;
        if ($day_diff < 0 || $month_diff < 0)
        $year_diff--;
        return $year_diff;
    }

}