package com.seoul.app.look;

import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
@RequiredArgsConstructor
public class ParkIdController {

    // 맵 경로에 매핑되는 메서드
    @GetMapping("/parkId1")
    public String park1(){
        return "parkId/parkId1"; // home 디렉토리 내의 home 뷰를 반환
    }

    // 맵 경로에 매핑되는 메서드
    @GetMapping("/parkId2")
    public String park2(){
        return "parkId/parkId2"; // home 디렉토리 내의 home 뷰를 반환
    }

    // 맵 경로에 매핑되는 메서드
    @GetMapping("/parkId3")
    public String park3(){
        return "parkId/parkId3"; // home 디렉토리 내의 home 뷰를 반환
    }

    // 맵 경로에 매핑되는 메서드
    @GetMapping("/parkId4")
    public String park4(){
        return "parkId/parkId4"; // home 디렉토리 내의 home 뷰를 반환
    }

    // 맵 경로에 매핑되는 메서드
    @GetMapping("/parkId5")
    public String park5(){
        return "parkId/parkId5"; // home 디렉토리 내의 home 뷰를 반환
    }

    // 맵 경로에 매핑되는 메서드
    @GetMapping("/parkId6")
    public String park6(){
        return "parkId/parkId6"; // home 디렉토리 내의 home 뷰를 반환
    }

}
