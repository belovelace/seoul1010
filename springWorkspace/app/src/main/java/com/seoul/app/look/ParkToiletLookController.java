package com.seoul.app.look;

import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
@RequiredArgsConstructor
public class ParkToiletLookController {

    // 맵 경로에 매핑되는 메서드
    @GetMapping("/toilet")
    public String map(){
        return "parkToiletLook"; // home 디렉토리 내의 home 뷰를 반환
    }
}
